<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create("users", function(Blueprint $table){
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email');
			$table->string('password');
			$table->string('token');
			$table->integer('group');
        	$table->string('remember_token');
			$table->timestamps();
		});

		User::create([
			"firstname" => "Organisateur",
			"lastname" => "Meaweb",
			"email" => "organisateur@meaweb.com",
			"password" => Hash::make("test"),
			"group" => 1
		]);
		User::create([
			"firstname" => "Visiteur",
			"lastname" => "Meaweb",
			"email" => "visiteur@meaweb.com",
			"password" => Hash::make("test"),
			"group" => 0
		]);

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("users");
	}

}
