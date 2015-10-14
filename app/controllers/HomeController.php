<?php

class HomeController extends BaseController {
	public function home(){

		/*Mail::send('emails.auth.test', array('name' => 'IcePay'), function($message){
			$message->to('rocardpp@gmail.com', 'IceTeck Developer test mail')->subject('Test email');
		});*/

		if (Auth::check()) {
			$user = User::find(Auth::user()->id);
			
			return View::make('site.dashboard')
				->with('user', $user)
				->with('title', 'IcePay - User Dashboard');
		}

		return View::make('site.home')
				->with('title', 'Disrupting local and online payment - Home');
	}

}
