<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Items extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("items", function(Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->text('description');
			$table->integer('checklist_id')->unsigned()->index();
			$table->foreign('checklist_id')->references('id')->on('checklists')->onDelete('cascade');
			$table->integer('dday_prev')->index();
			$table->integer('dedicated_to')->unsigned()->index();
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
		Schema::drop('items');
	}

}
