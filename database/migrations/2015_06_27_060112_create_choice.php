<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoice extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('choice', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned(); 
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('event_id')->unsigned();
			$table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
			$table->string('rsvp_option');    
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
		Schema::drop('choice');
	}

}
