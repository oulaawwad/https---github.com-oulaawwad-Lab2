<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class CatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct() {}
////////////////////////////////////////////////////////////////////////////////////
//		$url = 'http://192.168.1.23:8000/query/booktype/' . $type;
/////////////////////////////////////////////////////////////////////////////////

	public function showBooks($type){


	   
	//1- get file 


	$bookinfo;
	$flag=true;
	$count=-1;
	$json_ob;


		$file = new \Illuminate\Filesystem\Filesystem();
		$content = $file->get(__DIR__.'/../../books.txt');
		$books = explode ("\n",$content);
		if (sizeof($books) < 2){
			$flag=false;
			return response()->json(['Message' => 'There is no books in store.']);
			
		}

//book format;  id, title, count,type

		for ($i=0 ; $i<sizeof($books)-1 ; $i++)
		
		{
					$bookinfo[$i] = explode(",",$books[$i]);
					if ($bookinfo[$i][3] == $type){
					
						$count++;
						$json_ob[$count]['ID']=$bookinfo[$i][0];
						$json_ob[$count]['Tiltle'] = $bookinfo[$i][1];
						$json_ob[$count]['Count']=$bookinfo[$i][2];
					}
					else{
						return response()->json("error");
					}
		}

		return response()->json($json_ob);
		
	


}/////////////////////////////////////////////////////////////////////////////////////////////////////////


public function showbook($id){


	   
	//1- get file 


	$bookinfo;
	$flag=true;
	$count=-1;
	$json_ob;


		$file = new \Illuminate\Filesystem\Filesystem();
		$content = $file->get(__DIR__.'/../../books.txt');
		$books = explode ("\n",$content);
		if (sizeof($books) < 2){
			$flag=false;
			return response()->json(['Message' => 'There is no books in store.']);
			
		}

//book format;  id, title, count,type

		for ($i=0 ; $i<sizeof($books)-1 ; $i++)
		
		{
					$bookinfo[$i] = explode(",",$books[$i]);
					if ($bookinfo[$i][0] == $id){
					
						
						$json_ob[$count]['ID']=$bookinfo[$i][0];
						$json_ob[$count]['Tiltle'] = $bookinfo[$i][1];
						$json_ob[$count]['Count']=$bookinfo[$i][2];
					}
					else{
						return response()->json("error");
					}
		}

		return response()->json($json_ob);
		
	


}////////////////////////////////////////////////////////////////////////////////////////////////////////////// 













}////////////// class
