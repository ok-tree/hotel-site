<?php


try {
    
	include '../Includes/Autoload.php';
	$route = $_GET['action'] ?? 'home/main';

	$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';


	$route = new \Classes\Ok\EntryPoint($route, $method, new \Classes\HotelSite\HotelRoutes());
	
	
	ob_start();
	
		$route->run();

	$output = ob_get_clean();


	//title 값 임시로 null
	$title = '호텔포트폴리오'; 
	$template = [ 'output' => $output, 'title' => $title ];
    
    
}catch(PDOException $e){

	$title = '오류가 발생했습니다.';

	$output = '데이터베이스 오류 : ' . $e->getMessage() . ', 위치 : ' . 
					$e->getFile() . ' : ' . $e->getLine();
    
}
include '../Templates/layout.html.php';