<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class IcePayTransaction extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	//protected $fillable = array('username', 'email', 'number', 'password', 'password_temp', 'code', 'country', 'newsletter', 'active');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'transactions';

}
