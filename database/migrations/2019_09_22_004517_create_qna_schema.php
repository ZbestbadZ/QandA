<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQnaSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //tajo database 3 bảng user, answer, question
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('question');
            $table->string('level')->default('Beginner');
            $table->boolean('solved')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });


        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->text('answer');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('question_id')->references('id')->on('questions');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('answers');

    }
}
