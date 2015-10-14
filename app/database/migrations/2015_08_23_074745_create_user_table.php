<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table){
			$table->increments('id');
			$table->string('email', 128)->unique();
			$table->string('username', 128)->unique();
			$table->string('password', 128);
			$table->string('password_temp', 128);
			$table->string('code');
			$table->integer('number');
			$table->string('country', 128);
			$table->boolean('newsletter')->default(0);
			$table->integer('active');
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
