<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->decimal('lng', 10, 7);
            $table->decimal('lat', 10, 7);
            $table->string('apt_num')->nullable();
            $table->timestamp('date_available');
            $table->unsignedInteger('monthly_price');
            $table->text('description');
            $table->decimal('num_beds', 3, 1);
            $table->decimal('num_baths', 3, 1);
            $table->unsignedInteger('square_ft');
            $table->unsignedInteger('num_favorites')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
}
