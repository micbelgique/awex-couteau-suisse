<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Checklists extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("checklists", function(Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->integer('mission_type');
			$table->text('small_description');
			$table->text('big_description');
			$table->integer('user_id')->unsigned()->index();
			$table->date('dday');
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
		Schema::drop('checklists');
	}

}
