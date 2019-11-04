
<p class="navigation">home > 호텔리스트 > 호텔정보</p> 
<form action="?action=<?=$isLoggedIn ? "reservation/confirm" : "author/loginError" ?>" method="POST" id="hotelInfo">
   
	<div class="grids">
		<h4><?=$dbList->title?> </h4>   
		<p><?=$dbList->addr1?></p>
	</div>
	<div class="grids">
		<input type="submit" value="예약하기" class="button">
	</div>
	<div class="grids">
		
		<div id="slideImgBox">
			<div id="prevButton">
				<i class="fas fa-angle-left"></i>
			</div>
			<div id="nextButton">
				<i class="fas fa-angle-right"></i>
			</div>
			<div class="imgBackground">
				<img src="" id="mainImg" alt="호텔이미지">
			</div>
		</div>
		<div id="smallSlideImg">
		<?php foreach($imgList->item as $key): ?>
			<img src="<?=$key->originimgurl?>" class="smallSlideImg" alt="호텔이미지">
		<?php endforeach; ?>
		</div>
	</div>
	<div class="grids CALENDAR_SWITCH_IMPORTANT CALENDAR_SWITCH">

		<?php include '../Templates/calendarInfo.html.php';?>
	</div>
	<div class="grids">
		<p>호텔소개 : <?=$dbList->overview?></p>
	</div>
	<div class="grids">
		<div id="map-canvas" style="width: 100%; height: 200px"></div>
	</div>
	
	<input type="hidden" id="reservationCheckIn"name="reservation[check_in]" value="">
	<input type="hidden" id="reservationCheckOut"name="reservation[check_out]" value="">
	<input type="hidden" name="reservation[hotel_id]" value="<?=$dbList->contentid?>">
	<input type="hidden" name="reservation[hotel_name]" value="<?=$dbList->title?>">
	<input type="hidden" name="hotel[hotel_id]" value="<?=$dbList->contentid?>">
	<input type="hidden" id="lat" value="<?=$dbList->mapy?>">
	<input type="hidden" id="lng" value="<?=$dbList->mapx?>">

</form>
