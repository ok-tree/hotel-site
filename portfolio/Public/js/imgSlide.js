window.onload = function(){
	let imgCount = 0;
	let imgSrc;
	let imgWidth = $('.smallSlideImg').width();

	imgSrc = 
	$('#smallSlideImg').children().eq(imgCount).attr('src');
	$('#mainImg').attr('src', imgSrc);

	let firstImg = $('#smallSlideImg').children().first();
	let lastImg = $('#smallSlideImg').children().last();

	function prevEnd(){
		firstImg = firstImg.offset();
		$('#smallSlideImg').offset({left : firstImg.left - imgWidth });
		firstImg = $('#smallSlideImg').children().first();
		lastImg = $('#smallSlideImg').children().last();
		lastImg.insertBefore(firstImg);
	}

	function nextEnd(){
		lastImg = lastImg.offset();
		$('#smallSlideImg').offset({rigth : lastImg.rigth + (imgWidth * 2) });
		firstImg = $('#smallSlideImg').children().first();
		lastImg = $('#smallSlideImg').children().last();
		firstImg.insertAfter(lastImg);
	}

	$('#prevButton').click(function(){
		if(!$('#smallSlideImg').is(':animated')){
			imgCount--;
			if($('.smallSlideImg').length > 5){
				$('#smallSlideImg').animate({marginLeft: '+=' + imgWidth}, 500);
			}

			if(imgCount == -1 && $('.smallSlideImg').length > 5){
				firstImg = $('#smallSlideImg').children().first();
				prevEnd();
				imgCount = 0;
			}else if(imgCount == -1 && $('.smallSlideImg').length < 6){
				imgCount = $('.smallSlideImg').length - 1;
			}

			imgSrc = $('#smallSlideImg').children().eq(imgCount).attr('src');
			$('#mainImg').attr('src', imgSrc);
		}
	});

	$('#nextButton').click(function(){
		if(!$('#smallSlideImg').is(':animated')){
			imgCount++;
			if($('.smallSlideImg').length - 5 < imgCount && $('.smallSlideImg').length > 5){
				$('#smallSlideImg').animate({marginLeft: '+=' + imgWidth}, 0);
				nextEnd();
				imgCount--;
			}

			if($('.smallSlideImg').length > 5){

					$('#smallSlideImg').animate({marginLeft: '-=' + imgWidth}, 500);

			}else if($('.smallSlideImg').length == imgCount){
				imgCount = 0;
			}
				
			imgSrc = $('#smallSlideImg').children().eq(imgCount).attr('src');
			$('#mainImg').attr('src', imgSrc);
		}
	});
}
