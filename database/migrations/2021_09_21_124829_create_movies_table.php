<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('adult');
            $table->string('backdrop_path');
            $table->string('original_language');
            $table->string('original_title');
            $table->longText('overview');
            $table->float('popularity');
            $table->string('poster_path');
            $table->date('release_date');
            $table->string('title');
            $table->boolean('video')->defaul(false);
            $table->integer('vote_average');
            $table->integer('vote_count');
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
        Schema::dropIfExists('movies');
    }
}
