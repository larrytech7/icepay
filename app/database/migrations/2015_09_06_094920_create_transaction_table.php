<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function($table){
			$table->increments('user_id');
			$table->string('tid');
			$table->string('sender_email', 128);
			$table->string('receiver_email', 128);
			$table->string('type', 128);
			$table->enum('status', array('completed', 'pending', 'failed'));
			$table->float('amount');
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
		Schema::drop('transactions');
	}

}
