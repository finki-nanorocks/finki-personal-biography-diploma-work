<?php
	
	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;
	
	class TableUsers extends Migration
	{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create('users', function (Blueprint $table) {
				
				$table->increments('id');
				$table->boolean('isAdmin')->default(0);
				$table->string('fullName');
				$table->string('email')->unique();
				$table->string('password');
				
				$table->string('img')->nullable();
				$table->string('address')->nullable();
				$table->string('institution')->nullable();
				$table->string('department')->nullable();
				$table->string('repoId')->nullable();
				$table->text('text')->nullable();
				
				$table->integer('idAssistant')->nullable()->unsigned();
				$table->foreign('idAssistant')->references('id')
					->on('users')
					->onDelete('set null');
				
				$table->integer('idCategory')->nullable()->unsigned();
				$table->foreign('idCategory')->references('id')
					->on('categories')
					->onDelete('set null');
				
				$table->string('remember_token', 100)->nullable();
			});
			
		}
		
		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Shema::drop('users');
		}
	}
