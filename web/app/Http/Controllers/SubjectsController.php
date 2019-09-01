<?php
	
	namespace App\Http\Controllers;
	
	use App\User;
	use Illuminate\Http\Request;
	use App\Subject;
	use Auth;
	use Validator;
	
	class SubjectsController extends Controller
	{
		
		/**
		 * @var bool
		 */
		protected $isAdminUser = false;
		
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
		 * Validating new subjects
		 *
		 * @param $request
		 * @return \Illuminate\Validation\Validator
		 */
		protected function validateSubject($request)
		{
			return Validator::make($request->all(), [
				'title' => 'required|string',
				'semester' => 'required|numeric',
				'status' => 'required|alpha',
				'place' => 'required|string',
			], [
				'title.required' => 'Полето е задолжително за наслов',
				'semester.required' => 'Полето е задолжително за семестар',
				'status.required' => 'Полето е задолжително за статус',
				'place.required' => 'Полето е задолжително за локација',
				'numeric' => 'Само броеви се дозволени',
				'alpha' => 'Само букви се дозволени'
			
			]);
		}
		
		/**
		 * Create new Subject by admin or teacher
		 *
		 * @param Request $request
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
		 */
		public function create(Request $request)
		{
			
			if ($request->isMethod('get')) {
				if ($this->checkAdmin()) {
					// RETURN ALL REGULAR USERS
					$users = User::where('isAdmin', 0)->get();
					return view('subjects/create', [
						'users' => $users
					]);
				}
				return view('subjects/create');
			}
			
			if ($request->isMethod('post')) {
				
				// VALIDATOR FOR CREATING SUBJECTS
				$validator = $this->validateSubject($request);
				
				if ($validator->fails()) {
					return redirect('subjects/create')
						->withErrors($validator)
						->withInput();
				}
				
				$subject = new Subject();
				$subject->title = $request['title'];
				$subject->semester = $request['semester'];
				$subject->status = $request['status'];
				$subject->place = $request['place'];
				
				$subject->idUser = ($this->checkAdmin()) ? $request['idUser'] : Auth::id();
				$subject->save();
				
				return redirect('subjects');
			}
			
			return redirect('subjects');
		}
		
		/**
		 * Read subjects per login user
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
		 */
		public function read()
		{
			if ($this->checkAdmin()) {
				return redirect('panel');
			}
			
			$subjects = Subject::where('idUser', Auth::id())->get();
			$user = Auth::user();
			
			return view('subjects/subjects', [
				'user' => $user,
				'subjects' => $subjects
			]);
		}
		
		/**
		 * Show edit form to admin or teacher
		 *
		 * @param $id
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
		 */
		public function edit($id)
		{
			$subject = Subject::find($id);
			
			// IF SUBJECT NOT FOUND
			if ($subject == null) {
				return redirect('subjects');
			}
			
			// IF USER IS ADMIN
			if ($this->checkAdmin()) {
				$users = User::where('isAdmin', 0)->get();
				$fullName = User::find($subject->idUser)->fullName;
				
				return view('subjects/edit', [
					'users' => $users,
					'subject' => $subject,
					'fullName' => $fullName
				]);
			}
			
			// IF TEACHER NOT CREATE IT, REDIRECT BACK
			if ($subject->idUser != Auth::id()) {
				return redirect('subjects');
			}
			
			return view('subjects/edit', [
				'subject' => $subject
			]);
		}
		
		/**
		 * Update subject by admin or user
		 *
		 * @param Request $request
		 * @param $id
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function update(Request $request, $id)
		{
			
			$subject = Subject::find($id);
			
			// IF SUBJECT NOT FOUND
			if ($subject == null) {
				return redirect('subjects');
			}
			
			// VALIDATOR FOR CREATING SUBJECTS
			$validator = $this->validateSubject($request);
			
			if ($validator->fails()) {
				return redirect('subjects/edit/' . $id)
					->withErrors($validator)
					->withInput();
			}
			
			// IF SUBJECT IS NOT FOR AUTH USER
			if ($subject->idUser != Auth::id() && !$this->checkAdmin()) {
				return redirect('subjects');
			}
			
			$subject->title = $request['title'];
			$subject->semester = $request['semester'];
			$subject->status = $request['status'];
			$subject->place = $request['place'];
			
			$subject->idUser = ($this->checkAdmin()) ? $request['idUser'] : Auth::id();
			$subject->save();
			
			return ($this->checkAdmin()) ? redirect()->back() : redirect('subjects');
		}
		
		/**
		 * Delete subject by admin or teacher
		 *
		 * @param Request $request
		 * @param $id
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function delete(Request $request, $id)
		{
			$subject = Subject::find($id);
			
			// SUBJECT NOT FOUND
			if ($subject == null) {
				return redirect('subjects');
			}
			
			// IF USER IS ADMIN OR SUBJECT BELONG TO THAT USER
			if ($this->checkAdmin() || ($subject->idUser == Auth::id())) {
				$subject->delete();
			}
			
			return redirect('subjects');
		}
	}
