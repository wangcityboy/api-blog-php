<?php
class Response{
	
	const JSON = 'json';
	
	public static function show($code,$message='',$data = array(),$type = self::JSON){
		if(!is_numeric($code)){
			return '';
		}
		
		
		$type = isset($_GET['format']) ? $_GET['format'] : self::JSON;
		
		$result = array(
			'code' => $code,
			'message' => $message,
			'data' => $data,
		);
		
		
		if ($type == 'json'){
			self::json($code, $message,$data);
			exit;
		}elseif ($type == 'type'){
			var_dump($result);
			exit;
		}elseif ($type == 'xml'){
			self::json($code, $message,$data);
			exit;
		}else{
			// TO DO
			exit;
		}
	}
	
	
	public static function  json($code,$message,$data = array()){
		if(!is_numeric($code)){
			return "";
		}
		
		$result = array(
			'code' => $code,
			'message' => $message,
			'data' => $data,
		);
		
		echo json_encode($result);
		exit;
	}
}