<?php
	
	namespace App\Http\Controllers;
	
	use Auth;
	
	class HomeController extends Controller
	{
		/**
		 * @var bool
		 */
		protected $isAdminUser = false;
		
		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct()
		{
			$this->middleware('auth');
		}
		
		/**
		 * Check admin is user, change value on $isAdminUser
		 *
		 * @return bool
		 */
		protected function checkAdmin()
		{
			$this->isAdminUser = false;
			
			$user = Auth::user();
			if ($user->isAdmin) {
				$this->isAdminUser = true;
			}
			
			return $this->isAdminUser;
		}
		
		/**
		 * Show the application home page.
		 *
		 * @return \Illuminate\Contracts\Support\Renderable
		 */
		public function index()
		{
			if ($this->checkAdmin()) {
				return redirect('/admin');
			}
			
			return view('home', [
				'user' => Auth::user()
			]);
		}
	}
