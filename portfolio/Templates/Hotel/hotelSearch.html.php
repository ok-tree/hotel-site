<form action="?action=hotel/main&page=1" id="search" class="grids" method="POST">
	<div class="inputBox">
		<label for="place">목적지</label>
		<input type="text" id="place" name="place" placeholder="목적지" />
	</div>
	<div class="inputBox">
		<label for="">체크인</label>
		<input type="text" id="checkIn" name="checkIn" placeholder="체크인" readonly />
	</div>
	<div class="inputBox">
		<label for="">체크아웃</label>
		<input type="text" id="checkOut" name="checkOut"  placeholder="체크아웃" readonly />
	</div>						
	<div class="inputBox">
		<input type="submit" class="button" value="검색">
	</div>
	<div class="inputBox CALENDAR_SWITCH" id="calandarBox">
		<?php include '../Templates/calendar.html.php';?>
	</div>
	<input type="hidden" name="action" value="hotel/main">
	<input type="hidden" name="page" value="1">
</form>