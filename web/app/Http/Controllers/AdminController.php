<?php
	
	namespace App\Http\Controllers;
	
	use App\User;
	use Illuminate\Http\Request;
	use Auth;
	use Validator;
	
	class AdminController extends Controller
	{
		/**
		 * @var bool
		 */
		protected $isAdminUser = false;
		
		/**
		 * Validation for creating user
		 *
		 * @param $request
		 * @return \Illuminate\Validation\Validator
		 */
		protected function validateUser($request)
		{
			return Validator::make($request->all(), [
				'fullName' => 'required|string|max:225',
				'email' => 'required|email|max:225|unique:users',
				'password' => 'required|string|min:6',
			
			], [
				'fullName.required' => 'Полето е задолжително за титула, име и презиме',
				'email.required' => 'Полето е задолжително за е-пошта',
				'password.required' => 'Полето е задолжително за лозинка',
				'max' => 'Дозволени се највеќе 225 карактери',
				'unique' => 'Веќe постои таква е-пошта во база',
				'min' => 'Лозинката мора да е најмалку 6 карактери',
				'string' => 'Само string вредности се дозволени за полето'
			
			]);
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
		 * Show admin page
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse\Illuminate\Routing\Redirector|\Illuminate\View\View
		 */
		public function index()
		{
			if ($this->checkAdmin()) {
				return view('admin/admin');
			}
			
			return redirect('home');
		}
		
		/**
		 * To show panel for management
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
		 */
		public function showManagerPanel()
		{
			if ($this->checkAdmin()) {
				$teachers = User::where('isAdmin', 0)->get();
				return view('admin/panel', [
					'teachers' => $teachers
				]);
			}
			return redirect('home');
			
		}
		
		/**
		 * Login admin like user
		 *
		 * @param Request $request
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function loginLikeUser(Request $request)
		{
			if ($this->checkAdmin()) {
				
				$userId = $request['userId'];
				$user = User::findOrFail($userId);
				Auth::logout();
				Auth::login($user);
			}
			
			return redirect('home');
		}
		
		/**
		 * Delete user by admin
		 *
		 * @param Request $request
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function deleteUser(Request $request)
		{
			if ($this->checkAdmin()) {
				
				$userId = $request['userId'];
				$user = User::findOrFail($userId);
				$user->delete();
			}
			return redirect()->back();
		}
		
		/**
		 * Create user by admin
		 *
		 * @param Request $request
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
		 */
		public function createUser(Request $request)
		{
			
			if (!$this->checkAdmin()) {
				return redirect('home');
			}
			
			if ($request->isMethod('post')) {
				
				$validator = $this->validateUser($request);
				if ($validator->fails()) {
					return redirect()->back()
						->withErrors($validator)
						->withInput();
				}
				
				$user = new User();
				$user->fullName = $request['fullName'];
				$user->email = $request['email'];
				$user->password = bcrypt($request['password']);
				$user->save();
				
				return redirect()->to('panel');
			}
			
			return view('admin/add');
		}
	}
