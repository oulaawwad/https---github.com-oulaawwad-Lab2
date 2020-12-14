<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //



    public function buy($id){
		$url = 'http://192.168.1.23:8000/query/checkBooks/'.$id;
		$page = file_get_contents($url);
		$resp = response()->json(json_decode($page));
		$flag = json_decode($page)->Message;
		if ($flag == 'error'){
			return response()->json(['Message' => 'Error ocured']);
		}
		
		if ($flag == 'done'){
            
		$url3 = 'http://192.168.1.23:8001/query/checkBooks/'.$id;
		$page3 = file_get_contents($url3);
		$url2 ='http://192.168.1.23:8000/buy/'.$id;
		$page2 = file_get_contents($url2);
		return response()->json(json_decode($page2));
		}
	}
}
