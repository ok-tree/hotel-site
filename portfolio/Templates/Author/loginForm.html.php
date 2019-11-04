<?php

echo 'loginForm';

?>


<form action="" method="POST">
   
    <p>
        <label for="">이메일</label>
        <input type="text" name="author[author_email]" >
    </p>
    <p>
        <label for="">비밀번호</label>
        <input type="password" name="author[author_password]" >
    </p>
    
    <input type="submit" value="로그인"> 
</form>