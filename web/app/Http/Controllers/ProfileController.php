<?php
	
	namespace App\Http\Controllers;
	
	use App\Category;
	use App\User;
	use Illuminate\Http\Request;
	use Auth;
	use Validator;
	use Illuminate\Support\Facades\Storage;
	use Illuminate\Support\Facades\File;
	
	
	class ProfileController extends Controller
	{
		
		/**
		 * Validate img when uploading
		 * @param $request
		 * @return \Illuminate\Validation\Validator
		 */
		protected function validateImg($request)
		{
			return Validator::make($request->all(), [
				'img' => 'required|image|mimes:png|max:2048|dimensions:max_width=251,max_height=251',
			],
				[
					'required' => 'Полето е задолжително за слика',
					'image' => 'Невалидна фотографија',
					'mimes' => 'Дозволен формат за слика е само png',
					'max' => 'Сликата мора да е помала од 2mb',
					'dimensions' => 'Сликата не треба да има поголеми димензии од 250x250'
				]);
		}
		
		/**
		 * Show teacher info
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function index()
		{
			$user = Auth::user();
			$categories = Category::all();
			$users = User::where('isAdmin', 0)
				->where('id', '!=', $user->id)
				->get();
			
			return view('profile/profile', [
				'user' => $user,
				'users' => $users,
				'categories' => $categories,
			]);
		}
		
		/**
		 * Upload img with override
		 *
		 * @param Request $request
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
		 */
		public function uploadImg(Request $request)
		{
			// VALIDATE IMG
			$validator = $this->validateImg($request);
			if ($validator->fails()) {
				return redirect('/profile')
					->withErrors($validator)
					->withInput();
			}
			
			$user = Auth::user();
			
			// FIRST TIME UPLOAD IMG
			if ($user->img === null || $user->img == '') {
				$cover = $request->file('img');
				$extension = $cover->getClientOriginalExtension();
				Storage::disk('public')
					->put($cover->getFilename() . '.' . $extension, File::get($cover));
				
				$user->img = $cover->getFilename() . '.' . $extension;
				$user->save();
				
				return redirect('/profile')
					->withInput([
						'imgStatus' => 200,
						'imgMessage' => 'Успешно ажурирана фотографија',
					]);
			}
			
			$img = $user->img;
			Storage::disk('public')->delete($img);
			
			$cover = $request->file('img');
			$extension = $cover->getClientOriginalExtension();
			Storage::disk('public')->put($cover->getFilename() . '.' . $extension, File::get($cover));
			
			$user->img = $cover->getFilename() . '.' . $extension;
			$user->save();
			
			return redirect('/profile')
				->withInput([
					'imgStatus' => 200,
					'imgMessage' => 'Успешно ажурирана фотографија',
				]);
		}
		
	}
