<?php
	
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Category extends Model
	{
		protected $primaryKey = 'id';
		protected $table = 'categories';
		public $timestamps = false;
		
		/**
		 * @return \Illuminate\Database\Eloquent\Relations\HasMany
		 */
		public function users()
		{
			return $this->hasMany('App\User', 'idCategory', 'id');
		}
	}
