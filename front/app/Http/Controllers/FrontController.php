<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class FrontController extends Controller{

  public function __construct(){}
	
  /////////// show all books

	 public function getBooks($type){
	
		$url = '';
		$url = 'http://192.168.1.23:8000/query/booktype/' . $type;
		
		$page = file_get_contents($url); 
		$end = microtime(true); 
		echo "time:" . ($end - $start);
		return response()->json(json_decode($page));
	}
	/////////////////////////////////////////////////////////////////////////////////////////////


	public function getBook($id){
	
		$url = '';
        $url = 'http://192.168.1.23:8000/query/bookid/' . $id;
		
		$page = file_get_contents($url); 
		return response()->json(json_decode($page));
	}







}
