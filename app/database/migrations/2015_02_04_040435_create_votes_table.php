<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('votes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('school_no');
			$table->string('school_name');
			$table->string('vote_title');
			$table->integer('vote_amount');
			$table->datetime('start_at');
			$table->datetime('end_at');
			$table->integer('vote_goal');
			$table->integer('can_select');
			$table->string('builder_name');
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
		Schema::drop('votes');
	}

}
