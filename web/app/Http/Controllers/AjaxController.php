<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use Validator;
	use App\User;
	use Hash;
	
	class AjaxController extends Controller
	{
		/**
		 * Validate user info
		 *
		 * @param $request
		 * @return \Illuminate\Validation\Validator
		 */
		protected function validateUserInfo($request, $emailValidator)
		{
			
			return Validator::make($request->all(), [
				'email' => $emailValidator,
				'fullName' => 'required|max:200',
				'address' => 'required|max:200',
				'institution' => 'required|max:200',
				'department' => 'required|max:200',
				'idAssistant' => '',
				'idCategory' => '',
				'userId' => 'required|numeric',
			], [
				'required' => 'Полето е задолжително',
				'max' => 'Дозволени се највеќе 200 карактери.',
				'url' => 'Невaлидна репозитори патека',
				'numeric' => 'Дозволени се само броеви',
				'email' => 'Невалиден формат на е-пошта',
				'unique' => 'Веќе искористена е-пошта',
			]);
			
		}
		
		/**
		 * Validate resume
		 *
		 * @param $request
		 * @return \Illuminate\Validation\Validator
		 */
		protected function validateResume($request)
		{
			return Validator::make($request->all(), [
				'text' => 'required|max:1500',
				'userId' => 'required',
			], [
				'required' => 'Задолжителнo е полето за резиме.',
				'max' => 'Дозволени се највеќе 1500 карактери.'
			]);
		}
		
		/**
		 * Validate user password
		 *
		 * @param $request
		 * @return \Illuminate\Validation\Validator
		 */
		protected function validateUserPassword($request)
		{
			return Validator::make($request->all(), [
				'oldPassword' => 'required|min:6',
				'newPassword' => 'required|min:6',
				'userId' => 'required|numeric',
			], [
				'required' => 'Полето е задолжително',
				'min' => 'Дозволени се најмалку 6 карактери.',
				'numeric' => 'Дозволени се само броеви',
			]);
		}
		
		/**
		 * Ajax append resume text
		 *
		 * @param Request $request
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function editResume(Request $request)
		{
			$validator = $this->validateResume($request);
			if ($validator->fails()) {
				return response()
					->json([
						'status' => 404,
						'message' => $validator->errors()->first(),
					]);
			}
			
			$text = $request['text'];
			$userId = $request['userId'];
			
			$user = User::find($userId);
			if ($user == null) {
				return response()
					->json([
						'status' => 404,
						'message' => 'Невалиден пристап. Контактирајте го администраторот.',
					]);
			}
			
			$user->text = $text;
			$user->save();
			
			return response()
				->json([
					'status' => 200,
					'message' => 'Успешна aжурирано резиме.',
				]);
		}
		
		/**
		 * Ajax edit user info
		 *
		 * @param Request $request
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function editUserInfo(Request $request)
		{
			$emailValidator = 'required|email|unique:users';
			if ($request["email"] == null) {
				$emailValidator = '';
			}
			
			$validator = $this->validateUserInfo($request, $emailValidator);
			if ($validator->fails()) {
				return response()
					->json([
						'status' => 404,
						'message' => $validator->errors(),
					]);
			}
			
			$userId = $request['userId'];
			$user = User::find($userId);
			if ($user == null) {
				return response()
					->json([
						'status' => 404,
						'message' => ['userId' => 'Невалиден пристап. Контактирајте го администраторот.'],
					]);
			}
			
			if ($emailValidator != '') {
				$user->email = $request['email'];
			}
			$user->fullName = $request['fullName'];
			$user->address = $request['address'];
			$user->institution = $request['institution'];
			$user->department = $request['department'];
			$user->repoId = $request['repoId'];
			$user->idAssistant = $request['idAssistant'];
			$user->idCategory = $request['idCategory'];
			$user->save();
			
			return response()
				->json([
					'status' => 200,
					'message' => 'Успешни променети информации.',
				]);
		}
		
		/**
		 * Change your password
		 *
		 * @param Request $request
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function updateUserPassword(Request $request)
		{
			$validator = $this->validateUserPassword($request);
			if ($validator->fails()) {
				return response()
					->json([
						'status' => 404,
						'message' => $validator->errors(),
					]);
			}
			
			$userId = $request["userId"];
			$user = User::find($userId);
			if ($user == null) {
				return response()
					->json([
						'status' => 404,
						'message' => ['userId' => 'Невалиден пристап. Контактирајте го администраторот.'],
					]);
			}
			
			if (Hash::check($request["oldPassword"], $user->password)) {
				$user->password = bcrypt($request["newPassword"]);
				$user->save();
				return response()
					->json([
						'status' => 200,
						'message' => 'Успешно променета лозинка.',
					]);
			}
			
			return response()
				->json([
					'status' => 404,
					'message' => ['oldPassword' => 'Вашата лозинка не се совпаѓа со веќе постоечката, обидите се повторно.'],
				]);
		}
	}
