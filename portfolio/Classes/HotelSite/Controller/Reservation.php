<?php
namespace Classes\HotelSite\Controller;

class Reservation
{   
	private $hotelDatabase;
	private $reservationDatabase;
	private $authorDatabase;
	private $tableJoinDatabase;
	private $register;
	private $hotelApiController;

	public function __construct($hotelDatabase, $reservationDatabase, $authorDatabase, $tableJoinDatabase, $register, $hotelApiController)
	{
		$this->hotelDatabase = $hotelDatabase;
		$this->reservationDatabase = $reservationDatabase;
		$this->authorDatabase = $authorDatabase;
		$this->tableJoinDatabase = $tableJoinDatabase;
		$this->register = $register;
		$this->hotelApiController = $hotelApiController;
	}

	public function main()
	{
		$isLoggedIn = $this->register->isLoggedIn();
		
		if($isLoggedIn){
			$dbList = [];
			$tableJoinList = $this->tableJoinDatabase->findByColumnAll('author_id', $_SESSION['author_id'] );
			$author = $this->authorDatabase->findByColumnAll('author_id', $_SESSION['author_id']);
			foreach($tableJoinList as $key){
				$dbList[] = $this->reservationDatabase->findByColumn('reservation_id',   $key->reservation_id);
			}
			//var_dump($dbList);
			foreach($dbList as $key){
				$key->author_name = $author[0]->author_name;
			}
		include '../Templates/Reservation/reservation.html.php';
			
		}else{
			$resultMessage = '로그인을 해주세요.';
			include '../Templates/resultPage.html.php';
		}
	}
	
	public function confirm(){
		//echo 'confirm';
		$reservationDB = $this->reservationDatabase;
		$reservationInfo = $_POST['reservation'];
		$hotelInfo = $_POST['hotel'];
		$checkIn = $reservationInfo['check_in'];
		$checkOut = $reservationInfo['check_out'];
		if($checkIn && $checkOut){
			$reservationInfo = [
				'hotel_id' => $reservationInfo['hotel_id'],
				'hotel_name' => $reservationInfo['hotel_name'],
				'check_in' => date("Y-m-d",strtotime($checkIn)),
				'check_out' => date("Y-m-d",strtotime($checkOut))
			];

			$reservationDB->insert($reservationInfo);
			$tableJoinIsert = array(
				'reservation_id' => $reservationDB->lastId(),
				'hotel_id' => $hotelInfo['hotel_id'],
				'author_id' => $_SESSION['author_id']
			);

			$this->tableJoinDatabase->insert($tableJoinIsert);
		}else{
			echo '날짜를 선택해주세요';
		}
		
		header('location: index.php?action=reservation/success');
	}
	public function success(){
		$resultMessage = '예약이 완료되었습니다.';
		include '../Templates/resultPage.html.php';
	}

	public function delete(){
		$hotelDelete = $_POST['reservation']['reservation_id'];

		$this->reservationDatabase->delete('reservation_id',$hotelDelete);
		$this->tableJoinDatabase->delete('reservation_id', $hotelDelete);
		$resultMessage = '예약 삭제가 완료되었습니다.';
		include '../Templates/resultPage.html.php';
	}
	
	public function update(){
	
		//var_dump($_POST);
		$hotelId = $_POST['reservation']['hotel_id'];
		$dbList = $this->hotelDatabase->findById($hotelId);
		$dbList = $this->hotelApiController->hotelInfo($hotelId);
		//var_dump($dbList);
		$dbList = $this->hotelApiController->hotelInfo($hotelId);
		$imgList = $this->hotelApiController->hotelImage($hotelId);
		
		$isLoggedIn = $this->register->isLoggedIn();

		include '../Templates/Reservation/reservationUpdate.html.php';
	}
}