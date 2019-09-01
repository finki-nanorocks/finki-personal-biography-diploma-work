<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use App\Category;
	use App\User;
	use App\Subject;
	
	class ApiController extends Controller
	{
		/**
		 * Show all categories
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function showCategories()
		{
			$categories = Category::all();
			if ($categories == null) {
				return response()
					->json(['status' => 404, 'message' => 'Нема податоци.']);
			}
			
			return response()
				->json(['status' => 200, 'data' => $categories], 200,
					['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
					JSON_UNESCAPED_UNICODE);
		}
		
		/**
		 * Show one category
		 *
		 * @return \Illuminate\Http\JsonResponse
		 * @param $id
		 */
		public function showCategory($id)
		{
			$category = Category::find($id);
			if ($category == null) {
				return response()
					->json(['status' => 404, 'message' => 'Нема податоци.']);
			}
			
			return response()
				->json(['status' => 200, 'data' => $category], 200,
					['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
					JSON_UNESCAPED_UNICODE);
		}
		
		/**
		 * Show users per category
		 *
		 * @return \Illuminate\Http\JsonResponse
		 * @param $id
		 */
		public function showUsersPerCategory($id)
		{
			$category = Category::find($id);
			if ($category == null) {
				return response()
					->json(['status' => 404, 'message' => 'Нема податоци.']);
			}
			$count = count($category->users->toArray());
			
			if (!$count) {
				return response()
					->json(['status' => 404, 'message' => 'Нема податоци.']);
			}
			
			return response()
				->json(['status' => 200, 'data' => $category->users], 200,
					['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
					JSON_UNESCAPED_UNICODE);
			
		}
		
		/**
		 * Show all users
		 *
		 * @return \Illuminate\Http\JsonResponse
		 */
		public function showUsers()
		{
			$users = User::all();
			if ($users == null) {
				return response()
					->json(['status' => 404, 'message' => 'Нема податоци.']);
			}
			
			return response()
				->json(['status' => 200, 'data' => $users], 200,
					['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
					JSON_UNESCAPED_UNICODE);
		}
		
		/**
		 * Show user category
		 *
		 * @return \Illuminate\Http\JsonResponse
		 * @param $id
		 */
		public function showUserCategory($id)
		{
			$user = User::find($id);
			if ($user == null) {
				return response()
					->json(['status' => 404, 'message' => 'Нема податоци.']);
			}
			$category = Category::find($user->idCategory);
			
			return response()
				->json(['status' => 200, 'data' => ['category' => $category]], 200,
					['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
					JSON_UNESCAPED_UNICODE);
		}
		
		/**
		 * Show one user
		 *
		 * @return \Illuminate\Http\JsonResponse
		 * @param $id
		 */
		public function showUser($id)
		{
			$user = User::find($id);
			if ($user == null or $user->isAdmin) {
				return response()
					->json(['status' => 404, 'message' => 'Нема податоци.']);
			}
			
			$assistantId = $user->idAssistent;
			if ($assistantId != null or $assistantId != '') {
				$assistant = User::find($assistantId);
				
				return response()
					->json(['status' => 200, 'data' => ['user' => $user, 'assistent' => $assistant]], 200,
						['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
						JSON_UNESCAPED_UNICODE);
			}
			
			return response()
				->json(['status' => 200, 'data' => ['user' => $user]], 200,
					['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
					JSON_UNESCAPED_UNICODE);
			
		}
		
		/**
		 * Show subjects per user
		 *
		 * @return \Illuminate\Http\JsonResponse
		 * @param $id
		 */
		public function showSubjectsPerUser($id)
		{
			$user = User::find($id);
			if ($user == null) {
				return response()
					->json(['status' => 404, 'message' => 'Нема податоци.']);
			}
			
			$subjects = Subject::where('idUser', $id)->get();
			if (count($subjects) == 0) {
				return response()
					->json(['status' => 404, 'message' => 'Нема податоци.']);
			}
			
			return response()
				->json(['status' => 200, 'data' => $subjects], 200,
					['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
					JSON_UNESCAPED_UNICODE);
			
		}
	}
