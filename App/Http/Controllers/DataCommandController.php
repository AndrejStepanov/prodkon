<?php

namespace App\Http\Controllers;

use App\Http\main_function;
use App\Models\User;
use App\Models\Project;
use Auth\LoginController;
use Auth\RegisterController;
use Illuminate\Http\Request;

class DataCommandController extends Controller{
	public function reciveCommand(Request $request){
		$data=$request->all();
		switch($data['type']){
			case('user.info.save'):{return (new User())->saveUserInfo(createTodo(nvl($data,null)));  };	
			case('user.prj.save'):{return (new Project())->saveMyPrjs(createArrTodo(nvl($data,null)));  };			
			default:{ throw new \App\Exceptions\KonsomException( 'Ошибка доступа','Нет доступа!'); };
		}
		
		return;
	}
}