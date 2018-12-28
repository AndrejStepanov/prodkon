<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model{
    protected $table = '_projects';
    protected $primaryKey = 'rec_id';

	protected $dates = [  'created_at', 'updated_at'];

	protected $fillable = ['name','description','link','owner'];

  	public  function getListProjectsInfo(){
		return $this->select('rec_id as id','name', 'description', 'link')
			->where('owner' ,'=', Auth::user()->id)
			->orderBy('rec_id')
			->get()->toArray();
	}
	
	public  function saveMyPrjs($data){
		$recs=array();
		foreach($data as $row)
			$tmp[]=$row['id'];
		$this->where('owner' ,'=', Auth::user()->id)-> whereNotIn('rec_id' ,$tmp)->delete();
		foreach($data as $row)
			if($row['id']>0)
				$this->where('owner' ,'=', Auth::user()->id)->where('rec_id','=',$row['id'] ) 
					->update([ 'name' => $row['name'], 'description' => $row['description'], 'link' => $row['link'] ]);
			else
				$this::create([
					'owner' => Auth::user()->id,
					'name' => $row['name'], 
					'description' => $row['description'], 
					'link' => $row['link'],
					'created_at' =>date("Y-m-d H:i:s", time()),
				]);
	}
	
}
