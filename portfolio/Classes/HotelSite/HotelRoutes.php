<?php
namespace Classes\HotelSite;

class HotelRoutes
{
	private $hotelDatabase;
	private $reservationDatabase;
	private $authorDatabase;
	private $tableJoinDatabase;
	private $register;
	private $hotelApiController;

	public function __construct(){
		include '../Includes/DatabaseConnection.php';

		$this->hotelDatabase = new \Classes\Ok\DatabaseTable($pdo, 'hotel', 'hotel_id');
		$this->reservationDatabase = new \Classes\Ok\DatabaseTable($pdo, 'reservation', 'reservation_id');
		$this->tableJoinDatabase = new \Classes\Ok\DatabaseTable($pdo, 'table_join','table_join_id');
		$this->authorDatabase = new \Classes\Ok\DatabaseTable($pdo, 'author','author_id');
		$this->register = new \Classes\Ok\register($this->authorDatabase, 'author_id', 'author_name', 'author_email', 'author_password');
		$this->hotelApiController = new \Classes\HotelSite\Controller\HotelApi();
	}

	public function getRoutes() : array{
		$hotelController = new \Classes\HotelSite\Controller\Hotel($this->hotelDatabase, $this->reservationDatabase, $this->tableJoinDatabase, $this->register, $this->hotelApiController);
		$reservationController = new \Classes\HotelSite\Controller\Reservation($this->hotelDatabase, $this->reservationDatabase, $this->authorDatabase, $this->tableJoinDatabase, $this->register, $this->hotelApiController );
		$myPageController = new \Classes\HotelSite\Controller\MyPage;
		$authorController = new \Classes\HotelSite\Controller\Author( $this->authorDatabase, $this->tableJoinDatabase, $this->register);


		$routes = [
			'home/main' => [
					'GET' => [
							'controller' => $hotelController,
							'action' => 'home'
					]
			],
			'hotel/main' => [
					'GET' => [
							'controller' => $hotelController,
							'action' => 'main'
					],
					'POST' => [
							'controller' => $hotelController,
							'action' => 'search'
					]
			],
			'hotel/list' => [
					'GET' => [
							'controller' => $hotelController,
							'action' => 'list'
					]
			],
			'hotel/info' => [
					'GET' => [
							'controller' => $hotelController,
							'action' => 'info'
					]
			],

			'reservation/confirm' => [
					'POST' => [
							'controller' => $reservationController,
							'action' => 'confirm'
					]
			],

			'reservation/delete' => [
					'POST' => [
							'controller' => $reservationController,
							'action' => 'delete'
					]
			],


			'reservation/main' => [
					'GET' => [
							'controller' => $reservationController,
							'action' => 'main'
					]
			],
			'reservation/update' => [
					'POST' => [
							'controller' => $reservationController,
							'action' => 'update'
					]
			],
			'reservation/success' => [
					'GET' => [
							'controller' => $reservationController,
							'action' => 'success'
					]
			],

			'myPage/main' => [
					'GET' => [
							'controller' => $myPageController,
							'action' => 'main'
					]
			],

			'author/signUp' => [
					'GET' => [
							'controller' => $authorController,
							'action' => 'signUpForm'
					],
					'POST' => [
							'controller' => $authorController,
							'action' => 'signUpInsert'
					]
			],
			'author/login' => [
					'GET' => [
							'controller' => $authorController,
							'action' => 'loginForm'
					],
					'POST' => [
							'controller' => $authorController,
							'action' => 'loginConfirm'
					]
			],
			'author/logout' => [
					'GET' => [
							'controller' => $authorController,
							'action' => 'logout'
					]
			],
			'author/delete' => [
					'GET' => [
							'controller' => $authorController,
							'action' => 'delete'
					]
			],
			'author/loginError' => [
					'POST' => [
							'controller' => $authorController,
							'action' => 'loginError'
					]
			]


		];

		return $routes;
	}
}