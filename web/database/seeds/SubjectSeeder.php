<?php
	
	use Illuminate\Database\Seeder;
	use App\Subject;
	use App\User;
	
	class SubjectSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
			$user_ids = User::all()->pluck('id')->toArray();
			
			$titles[] = 'Хирургија';
			$titles[] = 'Хирургија – клиничка пракса';
			$titles[] = 'Хирургија – семинар';
			$titles[] = 'Здравствена нега на хирушки болни и болни од сродните области';
			$titles[] = 'Здравствена нега во радиологија';
			$titles[] = 'Медицинска етика и деонтологија';
			$titles[] = 'Основи на научна работа';
			$titles[] = 'Судска медицина';
			$titles[] = 'Медицинска Етика';
			$titles[] = 'Основи на научноистражувачка работа';
			
			$semestars[] = '1';
			$semestars[] = '2';
			$semestars[] = '3';
			$semestars[] = '4';
			$semestars[] = '5';
			$semestars[] = '6';
			$semestars[] = '7';
			$semestars[] = '8';
			$semestars[] = '9';
			$semestars[] = '10';
			
			$places[] = 'Мед';
			$places[] = 'РТ';
			$places[] = 'Л';
			$places[] = 'Ф';
			$places[] = 'МСТ';
			
			$statuses[] = 'РЕД';
			$statuses[] = 'ИЗБ';
			
			for ($i = 0; $i < 60; $i++) {
				$subject = new Subject();
				$subject->title = $titles[array_rand($titles)];
				$subject->semester = $semestars[array_rand($semestars)];
				$subject->status = $statuses[array_rand($statuses)];
				$subject->place = $places[array_rand($places)];
				$subject->idUser = $user_ids[array_rand($user_ids)];
				$subject->save();
			}
			
		}
	}
