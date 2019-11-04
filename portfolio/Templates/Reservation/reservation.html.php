
<p class="navigation">home > 예약관리 </p>
	<?php foreach($dbList as $key):?>
	<form action="index.php" method="POST" id="schedule">  
		<div class="grids">
			<p><?=$key->hotel_name?></p>
			<p>예약자이름: <?=$key->author_name?></p>
			<p>숙박인원 :</p>
			<p>체크인 : <?=$key->check_in?></p>
			<p>체크아웃 : <?=$key->check_out?></p>
			<p>결제요금 :</p>
		</div> 
		<div class="grids">
			<button type="submit" name="action" formaction="index.php?action=reservation/update" class="button">수정</button>
			<button type="submit" name="action" formaction="index.php?action=reservation/delete" class="button">삭제</button>
		</div>    

		<input type="hidden" name="reservation[reservation_id]" value="<?=$key->reservation_id?>">
		<input type="hidden" name="reservation[hotel_id]" value="<?=$key->hotel_id?>">
		<input type="hidden" id="reservationCheckIn"name="reservation[check_in]" value="">
		<input type="hidden" id="reservationCheckOut"name="reservation[check_out]" value="">
	</form>
	<?php endforeach?>




