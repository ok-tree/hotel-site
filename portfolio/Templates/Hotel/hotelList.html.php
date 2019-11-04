<p class="navigation">home > 호텔리스트 > '<?=$place?>' 검색결과 <?=$dbList->body->totalCount?>개</p>
<?php foreach($dbList->body->items->item as $key) :?>
	<div class="hotelList">
			<div class="imgBox"><img src="<?=$key->firstimage?>" alt="호텔썸네일"></div>
			<div class="textBox">
					<h4><?=$key->title?></h4>
					<p><?=$key->addr1?></p>
					<i class="far fa-star rating"></i>
					<i class="far fa-star rating"></i>
					<i class="far fa-star rating"></i>
			</div>
			<button class="button">
					<a href="index.php?action=hotel/info&hotel_id=<?=$key->contentid?>">호텔보기</a>
			</button>
	</div>
<?php endforeach; ?>

<div id="pageNav">
	<a href="index.php?action=hotel/list&place=<?=$place?>&page=1">처음</a>

	<?php if(isset($_GET['page']) && $_GET['page'] > 9 ): ?> 
		<?php $pageNav = $_GET['page'] - 6; ?>
		...
	<?php endif; ?>
	<?php for($i=1+$pageNav; $i<=$lastPage; $i++): ?>
		<?php if(isset($_GET['page']) && $i == $_GET['page']): ?>
			<a class="CURRENT_PAGE" href="index.php?action=hotel/list&place=<?=$place?>&page=<?=$i?>"><?=$i?></a>
		<?php else: ?>
			<a href="index.php?action=hotel/list&place=<?=$place?>&page=<?=$i?>"><?=$i?></a>
		<?php endif; ?>
		<?php if($i == 10+$pageNav): $i = $lastPage; ?>
		...
		<?php endif; ?>
	<?php endfor; ?>
	<a href="index.php?action=hotel/list&place=<?=$place?>&page=<?=$lastPage?>">끝</a>
</div>