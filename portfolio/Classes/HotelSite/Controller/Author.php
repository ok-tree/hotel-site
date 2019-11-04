<?php
namespace Classes\HotelSite\Controller;

class Author
{
	private $authorDatabase;
	private $tableJoinDatabase;
	private $register;

	public function __construct( $authorDatabase, $tableJoinDatabase, $register)
	{
		$this->authorDatabase = $authorDatabase;
		$this->tableJoinDatabase = $tableJoinDatabase;
		$this->register = $register;
	}

	public function signUpForm()
	{
		include '../Templates/Author/signUpForm.html.php';
	}

	public function signUpInsert()
	{
		$author = $_POST['author'];

		if($author['author_password'] == $_POST['password_confirm'] && $this->register->signUpConfirm($author)){
			$resultMessage = '회원가입이 완료되었습니다.';
			include '../Templates/resultPage.html.php';
		}else{
			echo '비밀번호를 확인해주세요.';
		}
	}
	public function loginForm()
	{
		include '../Templates/Author/loginForm.html.php';
	}
	public function loginConfirm()
	{   
		$author = $_POST['author'];
		if($this->register->loginConfirm($author)){
			$resultMessage = '로그인 되었습니다.';
			include '../Templates/resultPage.html.php';
		}
	}
	public function logout(){
		$this->register->logout();
		$resultMessage = '로그아웃 되었습니다.';
		include '../Templates/resultPage.html.php';
	}
    
	public function isLoggedIn(){
		if($this->register->isLoggedIn()){
				echo '로그인중';
		}else {
				echo '로그아웃중';
		}
	}
	public function loginError(){
		$resultMessage = '로그인을 해주세요.';
		include '../Templates/resultPage.html.php';
	}
	public function delete(){
		$author = $_SESSION['author_id'];
		$this->register->logout();
		$this->authorDatabase->delete('author_id', $author);
	}
    
}