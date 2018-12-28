<?php

namespace App\Http\Controllers;

use App\Http\main_function;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class SocetCommandController extends Controller{
	public function reciveCommand(Request $request){
		$data=$request->all();
		switch($data['type']){
			case('user.info.by.id'):{  return json_encode( (new User() )->getUserInfo(nvl($data['userId'],null)) ); };
			case('prj.info.by.user'):{  return json_encode( (new Project() )->getListProjectsInfo(nvl($data['userId'],null)) ); };
			default:{ throw new \App\Exceptions\KonsomException( 'Ошибка доступа','Нет доступа!'); };
		}
		return;
	}
}