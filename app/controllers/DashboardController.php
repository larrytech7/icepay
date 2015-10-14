<?php

class DashboardController extends BaseController {
	
	public function dashboard(){

		//if (Auth::check()) {

			$user = User::find(Auth::user()->id);
			
			return View::make('site.dashboard')
				->with('user', $user)
				->with('title', 'IcePay - User Dashboard');
		//} else {
			//return Redirect::route('home');
		//}
		
	}

	public function viewUserProfile(){
		$user = User::find(Auth::user()->id);
			
			return View::make('site.userprofile')
				->with('user', $user)
				->with('title', 'IcePay - User Profile');
	}

}