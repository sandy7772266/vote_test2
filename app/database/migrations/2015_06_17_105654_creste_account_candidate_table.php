<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CresteAccountCandidateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_candidate', function(Blueprint $table)
		{
			$table->integer('account_id')->unsigned();
			$table->foreign('account_id')->references('id')->on('accounts');
			$table->integer('candidate_id')->unsigned();
			$table->foreign('candidate_id')->references('id')->on('candidates');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('account_candidate');
	}
}
