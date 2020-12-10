<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class FrontController extends Controller{

  public function __construct(){}
	public function getBooks($type){
	
		if (Cache::has($type))
		{	

			$book=Cache::get($type);
			return response()->json(json_decode($book));
		}
		else{

		$url = '';
		$url = 'http://192.168.1.23:8000/query/booktype/' . $type;//// my ip address
		
		$page = file_get_contents($url); 
		Cache::put($type , $page ,300);
		return response()->json(json_decode($page));
		}
	}
	/////////////////////////////////////////////////////////////////////////////////////////////


	public function getBook($id){
		if (Cache::has($id))
		{	

			$book=Cache::get($id);
			return response()->json(json_decode($book));
		}
		else{
	
		$url = '';
        $url = 'http://192.168.1.23:8000/query/bookid/' . $id;
		
		$page = file_get_contents($url); 
		Cache::put($id , $page ,300);
		return response()->json(json_decode($page));
		}
	}


}
