<?php
	
	use Illuminate\Database\Seeder;
	use App\Category;
	
	class CategorySeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
			$category = new Category();
			$category->name = 'Редовен професори';
			$category->save();
			
			$category = new Category();
			$category->name = 'Вонреден професор';
			$category->save();
			
			$category = new Category();
			$category->name = 'Доцент';
			$category->save();
			
			$category = new Category();
			$category->name = 'Асистент';
			$category->save();
			
			$category = new Category();
			$category->name = 'Помлад асистент';
			$category->save();
			
			$category = new Category();
			$category->name = 'Научен советник';
			$category->save();
			
			$category = new Category();
			$category->name = 'Виш научен соработник';
			$category->save();
			
			$category = new Category();
			$category->name = 'Научен соработник';
			$category->save();
			
			$category = new Category();
			$category->name = 'Насловен доцент';
			$category->save();
			
			$category = new Category();
			$category->name = 'Насловен вонреден професор';
			$category->save();
			
			$category = new Category();
			$category->name = 'Друго';
			$category->save();
		}
	}
