// JavaScript Document
$(function(){ 
	$('.retrie dt a').click(function(){
		var $t=$(this);
		if($t.hasClass('up')){
			$("#quick-screen1").hide();
			$(".retrie dt a").removeClass('up');
			$('.downlist').hide();
			$('.mask').hide();
		}else{
			$("#quick-screen1").show();
			$(".retrie dt a").removeClass('up');
			$('.downlist').hide();
			$t.addClass('up');
			$('.downlist').eq($(".retrie dt a").index($(this)[0])).show();
			$('.mask').show();
		}
	});

	$(".zzsc .tab a").mousedown(function(){
		$(this).addClass('on').siblings().removeClass('on');
		var index = $(this).index();
		number = index;
		$('.zzsc .content ul').hide();
		$('.zzsc .content ul:eq('+index+')').show();
		$('.zzsc .content ul:eq('+index+')').style.webkitTransform = $('.zzsc .content ul:eq('+index+')').style.transform = "translate3d(" + (-$('.zzsc .content ul:eq('+index+')').index * $('.zzsc .content ul:eq('+index+')').width) + "px,0,0)";
	});
});