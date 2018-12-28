<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model{
    protected $table = '_projects';
    protected $primaryKey = 'rec_id';

	protected $dates = [  'created_at', 'updated_at'];

	protected $fillable = ['name','description','link'];

  	public  function getListProjectsInfo(){
		return $this->select('rec_id as id','name', 'description', 'link')
			->where('owner' ,'=', Auth::user()->id)
			->orderBy('rec_id')
			->get()->toArray();
	}
	
}
