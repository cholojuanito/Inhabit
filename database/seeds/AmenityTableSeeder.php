<?php

use Illuminate\Database\Seeder;

class AmenityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('amenities');
        $table->insert([
            'amenity' => 'pets',
        ]);
        $table->insert([
            'amenity' => 'laundry',
        ]);
        $table->insert([
            'amenity' => 'parking',
        ]);
        $table->insert([
            'amenity' => 'dishwasher',
        ]);
        $table->insert([
            'amenity' => 'wifi',
        ]);
        $table->insert([
            'amenity' => 'a/c',
        ]);
        $table->insert([
            'amenity' => 'extra_storage',
        ]);
        $table->insert([
            'amenity' => 'utilites_included',
        ]);
        $table->insert([
            'amenity' => 'elevator',
        ]);
        $table->insert([
            'amenity' => 'wheelchair_accessible',
        ]);
        $table->insert([
            'amenity' => 'furnished',
        ]);
        $table->insert([
            'amenity' => 'public_transport',
        ]);
        $table->insert([
            'amenity' => 'deck_patio',
        ]);
    }
}
