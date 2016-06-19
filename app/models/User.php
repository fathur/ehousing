<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends EhousingModel implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('UserPassword');

	protected $primaryKey = 'UserId';

	protected $fillable = [
		'UserName','Nama','UserPassword','Email','UserStatus','Region','KodeProvinsi',
		'CreateUid','ModUid'
	];

	protected $appends =array('id');

	public function getIdAttribute()
	{
		return (int) $this->UserId;
	}

	public function getAuthPassword() {
		return $this->UserPassword;
	}

	public function post()
	{
		return $this->hasMany('Post','CreateUid');
	}

	public function provinsi()
	{
		return $this->belongsTo('Provinsi','KodeProvinsi');

	}

}
