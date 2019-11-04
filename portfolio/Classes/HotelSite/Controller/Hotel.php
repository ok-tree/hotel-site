<?php
namespace Classes\HotelSite\Controller;

class Hotel
{   
	private $hotelDatabase;
	private $reservationDatabase;
	private $tableJoinDatabase;
	private $register;
	private $hotelApiController;

	public function __construct($hotelDatabase, $reservationDatabase, $tableJoinDatabase, $register, $hotelApiController)
	{
		$this->hotelDatabase = $hotelDatabase;
		$this->reservationDatabase = $reservationDatabase;
		$this->tableJoinDatabase = $tableJoinDatabase;
		$this->register = $register;
		$this->hotelApiController = $hotelApiController;
	}
	public function home(){
		include '../Templates/Hotel/homeContents.html.php';
	}
	public function main(){
		//$dbList = $this->hotelDatabase->find();
		$pageNav = 0;
		isset($_GET['place']) ? $place = $place['place'] : $place = '서울시';
		$geoResult = $this->hotelApiController->getGeoInfo($place);
		//var_dump($geoResult->result->geometry);
		if(isset($geoResult->result->geometry->location)){
			$geoResult = $geoResult->result->geometry;
			$dbList = $this->hotelApiController->hotelSearch($geoResult);
		}else if($geoResult->status == "ZERO_RESULTS"){
			echo "검색된 값이 없습니다.";
		}
		
		if(empty($dbList)){
			echo '검색된 값이 없습니다.';
		}
		$lastPage = $this->totalPage($dbList);
		include '../Templates/Hotel/hotelList.html.php';
	}
	
	public function search(){
		
		header('location: index.php?action=hotel/list&place=' .$_POST['place'] . '&page=1');
		
	}

	public function list(){
		$pageNav = 0;
		$page = $_GET['page'];
		$place = $_GET['place'];
		$geoResult = $this->hotelApiController->getGeoInfo($place);
		//var_dump($geoResult->result->geometry);
	
		$geoResult = $geoResult->result->geometry;
		$dbList = $this->hotelApiController->hotelSearch($geoResult, $page);
		
		$lastPage = $this->totalPage($dbList);
		include '../Templates/Hotel/hotelList.html.php';
	}

	public function info(){
		//echo 'infomation';

		$hotelId = $_GET['hotel_id'];
		$dbList = $this->hotelDatabase->findById($hotelId);
		$dbList = $this->hotelApiController->hotelInfo($hotelId);
		$imgList = $this->hotelApiController->hotelImage($hotelId);
		//var_dump($imgList);
		$isLoggedIn = $this->register->isLoggedIn();

		include '../Templates/Hotel/hotelInfo.html.php';
	}
	public function totalPage($dbList){
		$pageNo = $dbList->body->pageNo;
		$totalCount = $dbList->body->totalCount;
		$numOfRows = $dbList->body->numOfRows;
		$lastPage = ceil($totalCount / $numOfRows);
		return $lastPage;
	}
	

}