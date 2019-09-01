<?php
	
	namespace App;
	
	use Illuminate\Notifications\Notifiable;
	use Illuminate\Foundation\Auth\User as Authenticatable;
	
	class User extends Authenticatable
	{
		public $timestamps = false;
		protected $primaryKey = 'id';
		
		use Notifiable;
		
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'name',
			'email',
			'password',
		];
		
		/**
		 * The attributes that should be hidden for arrays.
		 *
		 * @var array
		 */
		protected $hidden = [
			'password',
			'remember_token',
			'isAdmin',
		];
		
		/**
		 * @return \Illuminate\Database\Eloquent\Relations\HasOne
		 */
		public function category()
		{
			return $this->hasOne('Category', 'id', 'idCategory');
		}
		
		/**
		 * @return \Illuminate\Database\Eloquent\Relations\HasMany
		 */
		public function subjects()
		{
			return $this->hasMany('Subject', 'idUser', 'id');
		}
		
		/**
		 * @return mixed
		 */
		public function getAdminId()
		{
			return $this->isAdmin;
		}
	}
