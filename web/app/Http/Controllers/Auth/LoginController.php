<?php
	
	namespace App\Http\Controllers\Auth;
	
	use App\Http\Controllers\Controller;
	use function GuzzleHttp\Promise\all;
	use Illuminate\Foundation\Auth\AuthenticatesUsers;
	use Illuminate\Http\Request;
	use Validator;
	
	class LoginController extends Controller
	{
		/*
		|--------------------------------------------------------------------------
		| Login Controller
		|--------------------------------------------------------------------------
		|
		| This controller handles authenticating users for the application and
		| redirecting them to your home screen. The controller uses a trait
		| to conveniently provide its functionality to your applications.
		|
		*/
		
		use AuthenticatesUsers;
		
		/**
		 * Where to redirect users after login.
		 *
		 * @var string
		 */
		protected $redirectTo = '/home';
		
		
		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct()
		{
			$this->middleware('guest')->except('logout');
		}
		
		/**
		 * Override method for validations
		 *
		 * @param Request $request
		 * @return \Illuminate\Http\RedirectResponse
		 */
		protected function validateLogin(Request $request)
		{
			$request->validate([
				$this->username() => 'required|string|email',
				'password' => 'required|string',
			], [
				'email.required' => 'Полето е задолжително за е-пошта',
				'password.required' => 'Полето е задолжително за лозинка',
				'email' => 'Невалидна е-пошта'
			]);
			
		}
		
	}
