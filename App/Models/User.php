<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Events\DataInfo ;

class User extends Authenticatable{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = '_users';
    protected $primaryKey = 'id';
    protected $dates = [  'created_at', 'updated_at'];
    protected $fillable = [
        'id','login', 'firstname', 'lastname', 'password','name','token', 'storage','password','timestamps','email1','systemLanguage','user_system','avatar','bio','role'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public  function getUserInfo($userId){
        $data =  $this->select('firstName','lastName','role' )->where('id' ,'=',$userId)->get()->toArray();
		return $data[0];
    }

	public  function saveUserInfo($todo){
        $this->where('id',Auth::user()->id )
            ->update(['FirstName' => $todo['firstName'], 'LastName' => $todo['lastName'], 'role' => $todo['role'] ]);
	}

}