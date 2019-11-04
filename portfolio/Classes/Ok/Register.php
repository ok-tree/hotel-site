<?php
namespace Classes\Ok;

class Register
{
    private $authorDatabase;
    private $id;
    private $name;
    private $email;
    private $password;
    
    public function __construct($authorDatabase, $idColumn, $nameColumn, $emailColumn, $passwordColumn)
    {
        session_start();
        $this->authorDatabase = $authorDatabase;
        $this->id = $idColumn;
        $this->name = $nameColumn;
        $this->email = $emailColumn;
        $this->password = $passwordColumn;
    }
    
    public function signUpConfirm($author)
    {
        if(empty($author[$this->name])){
            echo'이름을 입력해주세요.';
            return false;
        }
        if(empty($author[$this->email])){
            echo'이메일을 입력해주세요.';
            return false;
            
        }else if(filter_var($author[$this->email], FILTER_VALIDATE_EMAIL) == false){
            echo'유요하지 않은 이메일주소 입니다.';   
            return false;
        }else {
            if(count($this->authorDatabase->findByColumn($this->email, $author[$this->email])) > 0){
                $author[$this->email] = strtolower($author[$this->email]);
            }else{
                echo '중복 이메일 입니다.';
            }
        }
        if(empty($author[$this->password])){
            echo '비밀번호를 입력해주세요';
            return false;
        }else {
            $author[$this->password] = password_hash($author[$this->password], PASSWORD_DEFAULT);
            $this->authorDatabase->insert($author);
            return true;
        }
    }
    public function isLoggedIn()
    {   
        if(isset($_SESSION[$this->email])){
            $author = $this->authorDatabase->findByColumn($this->email, $_SESSION[$this->email]);
        }
        
        if(!empty($author) && $_SESSION[$this->password] == $author->{$this->password}){
            return true;
        }else {
            return false;
        }
    }
    
    public function loginConfirm($author)
    {
        $authorDB = $this->authorDatabase->findByColumn($this->email, $author[$this->email]);
        
        if(empty($authorDB)){
            echo '가입되지 않은 이메일입니다.';
            return false;
        }else if(password_verify($author[$this->password], $authorDB->{$this->password} )){
            session_regenerate_id();
            $_SESSION[$this->id] = $authorDB->{$this->id};
            $_SESSION[$this->email] = $authorDB->{$this->email};
            $_SESSION[$this->password] = $authorDB->{$this->password};
            return true;
            
        }else {
            echo '비밀번호가 틀립니다.';
            return false;
        }
    }
    
    public function logout()
    {
        session_unset();
    }
    
}