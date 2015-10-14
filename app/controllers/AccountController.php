<?php

class AccountController extends BaseController {
	
	public function getLogin(){ 
		return View::make('site.login')
				->with('title', 'IcePay - LogIn');
	}

	public function handleLogin(){ 
		$validator = Validator::make(Input::all(),
			array(
				'username'	=> 'required|alpha_dash|min:4',
				'password'	=>'required|alpha_num|min:6'
			)
		);

		if ($validator->fails()) {
			return Redirect::route('get-login')
					->withErrors($validator)
					->withInput();
		} else{
			$auth = Auth::attempt(array(
				'username' => Input::get('username'),
				'password' => Input::get('password'),
				'active'   => 1
			));

			if ($auth) {
				// Redirect to the intender page
				return Redirect::route('dashboard')
						->with('alertMessage', 'Your have successfully login to your account');
			} else{
				return Redirect::route('login')
						->with('alertError', 'Username/Password wrong, or account not activated.');
			}
		}

		return Redirect::route('login')
				->with('alertError', 'There was a problem loging you in.');
	}

	public function handleLogout(){
		Auth::logout();
		Session::flush();
		return Redirect::route('home')
				->with('alertMessage', 'Your have logout from your account.');
	}

	public function getCreate(){
		return View::make('site.register')
				->with('title', 'IcePay - Resgistration');
	}

	public function handleRegister(){
		$validator = Validator::make(Input::all(),
			array(
				'username'			=>'required|unique:users|alpha_dash|min:4',
				'email'	  			=>'required|email|unique:users',
				'country' 			=>'required',
				'number'  			=>'required|numeric|min:9',
				'password'			=>'required|alpha_num|min:6',
				'confirm_password'	=>'required|alpha_num|same:password',
				'terms'	   			=>'required'
			)
		);

		if ($validator->fails()) {

			return Redirect::route('home')
					->withErrors($validator)
					->withInput();

		} else{

			$username	= Input::get('username');
			$email		= Input::get('email');
			$number		= Input::get('number');
			$password   = Input::get('password');
			$country	= Input::get('country');
			$newsletter	= (Input::has('newsletter')) ? 1 : 0;

			//Activation code
			$code		= str_random(60);

			$user = User::create(array(
				'username' => $username,
				'email' => $email,
				'number' => $number,
				'password' => Hash::make($password),
				'country' => $country,
				'newsletter' => $newsletter,
				'code' => $code,
				'active' => 1
			));

			if ($user) {

				//Account email
				/*Mail::send('emails.auth.activate1', array('link' => URL::route('account-activate', $code),
					'username' => $username), function($message) use ($user){
					$message->to($user->email, $user->username)->subject('Activate your account');
				});
				*/

				return Redirect::route('home')
						//->with('alertMessage', 'Your account has been created! We have sent you an email to activate your account.');
						->with('alertMessage', 'Your account has been created.');
			}
		}
	}

	public function handleActivate($code){

		$user = User::where('code', '=', $code)->where('active', '=', 0);

		if ($user->count()) {
			$user = $user->first();

			// Update user to active state
			$user->active = 1;
			$user->code   = '';

			if ($user->save()) {
				return Redirect::route('home')
						->with('alertMessage', 'Account activated! You can now sign in!');
			}
		}

		return Redirect::route('home')
				->with('alertMessage', 'We could not activate your account. Try again later.');
	}

	public function getChangePassword(){
		return View::make('site.password')
					->with('title', 'IcePay - Change Password');
	}

	public function handleChangePassword(){
		$validator = Validator::make(Input::all(),
			array(
				'old_password' 		=> 'required',
				'password' 			=> 'required|min:6',
				'confirm_password' 	=> 'required|same:password'

			)
		);

		if ($validator->fails()) {
			return Redirect::route('change-password')
					->withErrors($validator);
		} else {

			$user 			= User::find(Auth::user()->id);
			$old_password 	= Input::get('old_password');
			$password 		= Input::get('password');

			if (Hash::check($old_password, $user->getAuthPassword())) {
				$user->password = Hash::make($password);

				if ($user->save()) {
					return Redirect::route('dashboard')
							->with('alertMessage', 'Your password has been changed.');
				}

			} else {
				return Redirect::route('change-password')
					->with('alertError', 'Oops! Your old password is not correct.');
			}

		}

		return Redirect::route('change-password')
				->with('alertError', 'Your password could not be changed.');
	}

	public function getManage($id, $edit){

		$data['user'] = User::find($id);
		return View::make('site.edituser')->with($data)
						->with('title', 'IcePay - Edit user account');;
	}

	public function postManage(){
        $rules = array(
                'username'			=>'required|alpha_dash',
				'email'	  			=>'required|email',
				'country' 			=>'required',
				'number'  			=>'required',
             );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $userToUpdate = User::find(Input::get('special'));
        $userToUpdate->username = Input::get('username');
        $userToUpdate->email = Input::get('email');
        $userToUpdate->number = Input::get('number');
        $userToUpdate->country = Input::get('country');
        $userToUpdate->newsletter = (Input::has('newsletter')) ? 1 : 0;

        $$userToUpdate->save();

        return Redirect::back()->with('alertMessage', 'Account updated successfully.');
    }


}
