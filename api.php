<?php
require_once("./global.php");
require_once(SITE_PATH."/include/Common.php");
require_once(SITE_PATH."/model/User.php");
require_once(SITE_PATH."/model/Article.php");
require_once(SITE_PATH."/model/PhotoDir.php");
require_once(SITE_PATH."/model/Photo.php");
class api
{
	const PUBLIC_KEY="http://www.ucai.cn";
    	function check()
        {
			$params = array();	
			$request = empty($_GET)? $_POST:$_GET;
			foreach($request as $key=>$value)
			{
				if($key!='sign')
				{
					$params[$key] = $value;
				}
			}
			ksort($params);
			$url = "";
			$count = count($params);
			$index = 0;
			foreach($params as $key=>$value)
			{
				if($index==$count-1)
				{
					$url .= "$key=".$value;
				}
				else
				{
					$url .= "$key=".$value."&";
				}
				$index++;
			}
			if(md5($url."#".self::PUBLIC_KEY) == $request['sign'])
			{
				echo $index;
			}
			else
			{
				echo "FAILED";
				die;
			}
        }	
        

	function main()
	{
		$action = $_REQUEST['act'];
		switch($action)
		{
			case "user":
				$user = new User();
				if(isset($_REQUEST['uid'])){
					$uid = intval($_REQUEST['uid']);
				    $userinfo = $user->getUser($uid);	
					$users[$uid] = $userinfo[0];
				}else{	
					$data = $user->getUser();
					$users = _fetch_array_list($data);
				}
				
				echo json_encode($users);
				break;
				
			case "home":
				$article = new Article();
				$articlelist = $article->getArticleHomeList();
				$_htmllist = array();
				while (!!$item = _fetch_array_list($articlelist)){
					$_htmllist[] = array(
							"id"=>$item['tg_id'],
							"username"=>$item['tg_username'],
							"classify"=>$item['tg_classify'],
							"title"=>$item['tg_title'],
							"content"=>$item['tg_content'],
							"image"=>$item['tg_image'],
							"readcount"=>$item['tg_readcount'],
							"date"=>$item['tg_date'],
					);
				}
				echo  json_encode($_htmllist);
				break;
					
			case "article":
				$article = new Article();
				$articlelist = $article->getArticleList();
				$_htmllist = array();
				while (!!$item = _fetch_array_list($articlelist)){
					$_htmllist[] = array(
							"id"=>$item['tg_id'],
							"username"=>$item['tg_username'],
							"classify"=>$item['tg_classify'],
							"title"=>$item['tg_title'],
							"content"=>$item['tg_content'],
							"image"=>$item['tg_image'],
							"readcount"=>$item['tg_readcount'],
							"date"=>$item['tg_date'],
					);		
				}
				echo  json_encode($_htmllist);
				break;
				
					
			case "dir":
				$photoDir = new PhotoDir();
				$photoDirList = $photoDir->getPhotoDirList();
				
				$_htmllist = array();
				while (!!$item = _fetch_array_list($photoDirList)){
					$_htmllist[] = array(
							"id"=>$item['tg_id'],
							"name"=>$item['tg_name'],
							"type"=>$item['tg_type'],
							"content"=>$item['tg_content'],
							"face"=>$item['tg_face'],
							"dir"=>$item['tg_dir'],
							"date"=>$item['tg_date'],
					);
				}
				echo json_encode($_htmllist);
				break;
				
				
			case "photo":
				$sid = $_REQUEST['sid'];
				$photo = new Photo();
				$photoList = $photo->getPhotoList($sid);
				
				$_htmllist = array();
				while (!!$item = _fetch_array_list($photoList)){
					$_htmllist[] = array(
							"id"=>$item['tg_id'],
							"name"=>$item['tg_name'],
							"url"=>$item['tg_url'],
							"content"=>$item['tg_content'],
							"sid"=>$item['tg_sid'],
							"username"=>$item['tg_username'],
							"readcount"=>$item['tg_readcount'],
							"date"=>$item['tg_date'],
					);
				}		
				echo json_encode($_htmllist);
				break;

		}
	}
}	
$api = new api();
$api->main();

