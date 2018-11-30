<?php

use Illuminate\Database\Seeder;
use App\Conversation;
use App\User;
use App\Listing;
use App\Message;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AmenityTableSeeder::class);

        // Populate the users and make one listing for each user
        factory(User::class, 100)->create()->each(
            function ($u) {
                $u->listings()->save(factory(Listing::class)->make());
            }
        );

        // Populate conversations
        factory(Conversation::class, 150)->create();

        $convos = Conversation::all();
        $users = User::all();

        // Populate the pivot table and messages as well
        $users->each(
            function ($user) use ($convos) {
                // Attach 1 - 4 random conversations to each user
                $conversations = $convos->random(rand(1, 4));
                $user->conversations()->attach(
                    $conversations->pluck('id')->toArray()
                );
                // Make 1 - 10 messages from each user in each conversation
                $conversations->each(
                    function ($convo) use ($user) {
                        $messages = factory(Message::class, rand(1, 10))->make([
                            'user_id' => $user->id,
                            'conversation_id' => $convo->id,
                        ]);
                        // Populate the messages
                        $messages->each(
                            function ($m) use ($convo) {
                                $convo->messages()->save($m);
                            }
                        );
                    }
                );
            }
        );

    }
}
