<?php
	
	use Illuminate\Database\Seeder;
	use App\User;
	use App\Category;
	
	class UserSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
			$user = new User();
			$user->fullName = 'Андреј Нанков';
			$user->email = 'andrejnankov@gmail.com';
			$user->password = password_hash("secret", PASSWORD_BCRYPT);
			$user->isAdmin = 1;
			$user->save();
			
			
			$category_ids = Category::all()->pluck('id')->toArray();
			
			DB::table('users')->insert([
				[
					'fullName' => 'д-р Биљана Јанеска',
					'email' => 'biljana.j@gmail.com',
					'password' => bcrypt('secret'),
					'idCategory' => $category_ids[array_rand($category_ids)],
					'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					'address' => 'Институт за судска медицина и криминалистика',
					'institution' => 'Институт за судска медицина и криминалистика',
					'department' => 'Катедра за судска медицина',
				],
				[
					'fullName' => 'д-р Ангелко Ѓорчев',
					'email' => 'angelco@gmail.com',
					'password' => bcrypt('secret'),
					'idCategory' => $category_ids[array_rand($category_ids)],
					'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					'address' => 'ЈЗУ Универзитетска клиника за пулмологија и алергологија Водњанска 17',
					'institution' => 'Клиника за пулмологија и алергологија',
					'department' => 'Катедра за интерна медицина',
				],
				[
					'fullName' => 'д-р Анастасика Попоска',
					'email' => 'anastasika.p@gmail.com',
					'password' => bcrypt('secret'),
					'idCategory' => $category_ids[array_rand($category_ids)],
					'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					'address' => 'ЈЗУ Универзитетска клиника за дигестивна хирургија Водњанска 17',
					'institution' => 'Клиника за ортопедски болести',
					'department' => 'Катедра за ортопедија',
				],
				[
					'fullName' => 'д-р Александар Шиколе',
					'email' => 'shikole.a@gmail.com',
					'password' => bcrypt('secret'),
					'idCategory' => $category_ids[array_rand($category_ids)],
					'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					'address' => 'ЈЗУ Универзитетска клиника за дигестивна хирургија Водњанска 17',
					'institution' => 'Клиника за нефрологија',
					'department' => 'Клиника за нефрологија',
				],
				[
					'fullName' => 'д-р на наука Александар Чапароски',
					'email' => 'caparoski.a@gmail.com',
					'password' => bcrypt('secret'),
					'idCategory' => $category_ids[array_rand($category_ids)],
					'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					'address' => 'ЈЗУ Универзитетска клиника за дигестивна хирургија Водњанска 17',
					'institution' => 'Клиника за неврохирургија',
					'department' => 'Катедра за хирургија',
				],
				[
					'fullName' => 'д-р Александар Караѓозов',
					'email' => 'karagjozov.a@gmail.com',
					'password' => bcrypt('secret'),
					'idCategory' => $category_ids[array_rand($category_ids)],
					'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					'address' => 'ЈЗУ Универзитетска клиника за дигестивна хирургија Водњанска 17',
					'institution' => 'Клиника за дигестивна хирургија',
					'department' => 'Катедра за хирургија',
				],
			]);
		}
	}
