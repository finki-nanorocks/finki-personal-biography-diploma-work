<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class TableSubjects extends Migration
	{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('subjects', function (Blueprint $table) {
				$table->increments('id');
				$table->string('title');
				$table->string('semester');
				$table->string('status');
				$table->string('place');
				
				$table->integer('idUser')->unsigned();
				$table->foreign('idUser')->references('id')
					->on('users')
					->onDelete('cascade');
			});
		}
		
		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Shema::drop('subjects');
		}
	}
