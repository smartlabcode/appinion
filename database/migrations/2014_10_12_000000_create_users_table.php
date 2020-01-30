<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar')->default('default.jpg');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('prezentacije', function(Blueprint $table){

            $table->bigIncrements('id');
            $table->string('email_autora');
            $table->string('ime_prezentacije');
            $table->boolean('otvorena');
            $table->string('gen_kod')->unique();
            $table->timestamps();
            //$table->rememberToken();

        });

        Schema::create('presentation_users', function(Blueprint $table){

            $table->bigIncrements('id');
            $table->integer('id_prezentacije');
            $table->string('ime');
            $table->string('prezime');
            $table->string('email')->unique();
            $table->string('password');
            //$table->rememberToken();
            $table->timestamps();
        });

        Schema::create('pitanja', function(Blueprint $table){

            $table->bigIncrements('id');
            $table->string('id_prezentacije');
            $table->string('pitanje');
            $table->string('odgovor1');
            $table->string('odgovor2');
            $table->string('odgovor3');
            $table->string('odgovor4');

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
        Schema::dropIfExists('prezentacije');
        Schema::dropIfExists('presentation_users');
        Schema::dropIfExists('pitanja');
        Schema::dropIfExists('odgovori');
    }
}
