<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model{
    protected $table = '_university';
    protected $primaryKey = 'uni_id';
    protected $dates = [  'date_born', 'date_accreditation', 'created_at', 'updated_at'];
    protected $fillable = ['city_id', 'isState', 'isHostel', 'hostelProc', 'hostelPlaces', 'isAccreditation', 'isMilitary', 'isSub', 'address', 'webSite', 'email', 'phones', 'abouts', 'created_at', 'updated_at', 'uniImg', 'rate', 'ratePlace', 'qtyStudents', 'uniName', 'dateBorn', 'dateAccreditation' ];

    public  function getUniversitysList(){
		return  $this->select('uni_id as value','uniName as text')->orderBy('city_id')->orderBy('uniName')->get()->toArray();
	}
    public  function getUniversitysForSearch(){
		return  convertToAssArr ( $this->select('uni_id','webSite','uniName','uniImg', 'rate')->get()->toArray(),$this->primaryKey);
	}
    public function Uni2Specs()    {
        return $this->hasMany('App\Models\Uni2Spec', 'uni_id','uni_id');
    }
    public function city()    {
        return $this->belongsTo('App\Models\Citys','city_id');
    }
}
