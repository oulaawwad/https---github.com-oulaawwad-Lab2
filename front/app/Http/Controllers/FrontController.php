<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class FrontController extends Controller{

  public function __construct(){}
	public function getBooks($type){
		$start = microtime(true);	

		if (Cache::has($type))
		{	

			$book=Cache::get($type);
			$endcache1 = microtime(true); 
			echo "cache:" . ($endcache1 - $start);
			return response()->json(json_decode($book));
		}
		else
		{

			//// load balancing using round rubin


            $load=load_flag(0);
            $url = '';

			if($load)
			{

	            $url = 'http://192.168.1.23:8000/query/booktype/' . $type;//// my ip address
				$page = file_get_contents($url); 
				Cache::put($type , $page ,300);
				$end = microtime(true); 
	        	echo ":" . ($end - $start);
				$load=true;
				return response()->json(json_decode($page));
		

			}
			
			else
			{

	            $url = 'http://192.168.1.23:8001/query/booktype/' . $type;//// my ip address
	            $page = file_get_contents($url); 
				Cache::put($type , $page ,300);
				$end = microtime(true); 
				echo ":" . ($end - $start);
				$load=false;
	            return response()->json(json_decode($page));
	
            }

		}
	}
	/////////////////////////////////////////////////////////////////////////////////////////////


	public function getBook($id){
		$start = microtime(true);	
		if (Cache::has($id))
		{	

			$book=Cache::get($id);
			$endcache1 = microtime(true); 
				echo "cache:" . ($endcache1 - $start);
			return response()->json(json_decode($book));
		}
		else
		{

            $load=load_flag(1);
            $url = '';

			if($load)
			{

				$url = 'http://192.168.1.23:8000/query/bookid/' . $id;
				$page = file_get_contents($url); 
				Cache::put($id , $page ,300);
				$end = microtime(true); 
				echo ":" . ($end - $start);
				$load=true;;

				return response()->json(json_decode($page));
		

			}

			else
			{

				$url = ''; //// second ip address
	            $page = file_get_contents($url); 
				Cache::put($type , $page ,300);
				$end = microtime(true); 
				echo ":" . ($end - $start);
				$load=false;

	            return response()->json(json_decode($page));

			}

		}
	}



	public function load_flag($num)
	{

		
		$flag;
		$info;
	    $file = new \Illuminate\Filesystem\Filesystem();
		$content = $file->get(__DIR__.'/../../loadbal.txt');
		$ff = explode ("\n",$content);
		

		for ($i=0 ; $i<sizeof($ff)-1 ; $i++)
		
		{
					$info[$i] = explode(",",$ff[$i]);

					if($num==0)
					{
						
						$flag=$info[$i][0];
						return $flag;
						
					}

					elseif($num==1)
					{
						$flag=$info[$i][1];
						return $flag;
					}
					elseif($num==2)
					{
						$flag=$info[$i][2];
						return $flag;
					}
		}

		


	}

	public function buyBook($id){
		$start = microtime(true);	
		if (Cache::has('Buy' . $id)){	
			$value = Cache::get('Buy' . $id);	
			$val = json_decode($value)->Message;
			if ($val != 'Buy done successfuly.'){
				$endcache1 = microtime(true); 
				echo "cache:" . ($endcache1 - $start);
				return response()->json(json_decode($value));
			}
			Cache::forget('Buy' . $id);
		}

			 $url = '';
			
            $load=load_flag(2);
            $url = '';

			if($load)
			{

				$url = $url = 'http://192.168.1.22:8000/buy/' . $id ;
				$page = file_get_contents($url);
	         	Cache::put('Buy'.$id , $page ,60);
	        	$end = microtime(true); 
				echo "oo:" . ($end - $start);
				$load=true;

		        return response()->json(json_decode($page));
		

			}


			else{

				$url = $url = 'http://192.168.1.22:8001/buy/' . $id ;
				$page = file_get_contents($url);
	         	Cache::put('Buy'.$id , $page ,60);
	        	$end = microtime(true); 
				echo "oo:" . ($end - $start);
				$load=true;
		        return response()->json(json_decode($page));

			}





		
	}	


}
