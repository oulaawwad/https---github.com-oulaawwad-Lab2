<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;// To use cache


class FrontController extends Controller{

  public function __construct(){}
	
  /////////// show all books

	 public function getBooks($topic){
	
		$url = '';
		$url = 'http://192.168.19.141:8000/query/booktopic/' . $topic;
		
		$page = file_get_contents($url); 
		$end = microtime(true); 
		echo "time:" . ($end - $start);
		return response()->json(json_decode($page));
	}


}
