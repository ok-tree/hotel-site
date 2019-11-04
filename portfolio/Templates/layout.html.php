<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/css/hotel.css" type="text/css">
		<title><?=$template['title']?></title>    
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
		<script src="https://kit.fontawesome.com/679f4ef469.js" crossorigin="anonymous"></script>		
	</head>

	<body>
		<div id="wrap">
			<nav class="grids">
				<ul>
					<li><a href="?action=home/main" >home</a></li>
					<li><a href="?action=hotel/main&page=1">호텔리스트</a></li>
					<li><a href="?action=reservation/main">예약관리</a></li>

					<?php if(empty($_SESSION)) : ?>
					<li><a href="?action=author/login">로그인</a></li>
					<li><a href="?action=author/signUp">회원가입</a></li>

					<?php else: ?>
					<li><a href="?action=myPage/main">마이페이지</a></li>
					<li><a href="?action=author/logout">로그아웃</a></li>
					<?php endif; ?>

				</ul>  
			</nav>
			<?php if(isset($_GET['action']) && $_GET['action'] == 'home/main'): ?>
				<section id="home" class="grids">
					<?php include '../Templates/Hotel/hotelSearch.html.php'; ?>
				</section>
				<section id="main" class="grids">   
					<?=$template['output']?>  
				</section>

			<?php else: ?>
				<section id="compass" class="grids">
					<?php include '../Templates/Hotel/hotelSearch.html.php'; ?>
				</section>
				<section id="main" class="grids">    
					<?=$template['output']?>  
				</section>  

			<?php endif; ?>
			<footer class="grids">
				<p>
					 copyright &copy; 2019 &ndash;
				<?php echo date('Y');?> Example OK ALL Rights Reserved.
				</p>
			</footer>
		</div>

		<script src="/js/hotel.js"></script>
		<script src="/js/googleMap.js"></script>
		<script src="/js/imgSlide.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=ServiceKey&callback=initMap&libraries=places" async defer></script>  

	</body>
</html>





