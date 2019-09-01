<?php
	
	namespace App\Http\Controllers;
	
	use App\Category;
	use Illuminate\Http\Request;
	use Auth;
	use Validator;
	
	class CategoriesController extends Controller
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
			
			if (Auth::check() && Auth::user()->isAdmin) {
				$this->isAdminUser = true;
			}
			return $this->isAdminUser;
		}
		
		/**
		 * Validating new category
		 *
		 * @param $request
		 * @return \Illuminate\Validation\Validator
		 */
		protected function validateCategory($request)
		{
			return Validator::make($request->all(), [
				'name' => 'required|string',
			], [
				'name.required' => 'Полето е задолжително за категорија',
			]);
		}
		
		/**
		 * Show all categories to admin
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function show()
		{
			if (!$this->checkAdmin()) {
				return redirect()->back();
			}
			$categories = Category::all();
			return view('categories/categories', [
				'categories' => $categories
			]);
		}
		
		/**
		 * Create new category
		 *
		 * @param Request $request
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function createCategory(Request $request)
		{
			$validator = $this->validateCategory($request);
			
			if ($validator->fails()) {
				return redirect()->back()
					->withErrors($validator)
					->withInput();
			}
			
			if ($this->checkAdmin()) {
				
				$category = new Category();
				$category->name = $request["name"];
				$category->save();
				
				return redirect()->back();
			}
			
			return redirect()->back();
		}
		
		/**
		 * Delete category by admin
		 *
		 * @param Request $request
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function deleteCategory(Request $request)
		{
			if (!isset($request["idCategory"])) {
				return redirect('admin/categories')->withInput([
					'msgErrCategory' => 'Невалидно бришење на категорија'
				]);
			}
			if ($this->checkAdmin()) {
				$category = Category::findOrFail($request['idCategory']);
				$category->delete();
			}
			
			return redirect()->back();
		}
		
		/**
		 * Edit category by admin
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
		 */
		public function editCategory($id)
		{
			if (!$this->checkAdmin()) {
				return redirect()->back();
			}
			$category = Category::findOrFail($id);
			return view('categories/edit', [
				'category' => $category
			]);
		}
		
		/**
		 * Update category by admin
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
		 */
		public function updateCategory(Request $request, $id)
		{
			$validator = $this->validateCategory($request);
			
			if ($validator->fails()) {
				return redirect()->back()
					->withErrors($validator)
					->withInput();
			}
			
			if (!$this->checkAdmin()) {
				return redirect()->back();
			}
			
			$category = Category::findOrFail($id);
			$category->name = $request['name'];
			$category->save();
			
			return redirect('admin/categories');
		}
	}
