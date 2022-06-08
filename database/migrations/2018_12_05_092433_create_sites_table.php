<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->char('title',255);
            $table->string('slogan');
            $table->text('description');
            $table->string('website');
            $table->string('email');
            $table->string('location');
            $table->string('telephone');
            $table->string('working_days');
            $table->string('facebook');
            $table->string('google');
            $table->string('twitter');
            $table->string('instagram');
            $table->string('linkedin');
            $table->string('skype');
            $table->text('attributes');
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
        Schema::dropIfExists('sites');
    }
}
