<?php
$pdo = new PDO('mysql:host=localhost;dbname=hoteldb;charset=utf8', 'hostname', '***********');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);