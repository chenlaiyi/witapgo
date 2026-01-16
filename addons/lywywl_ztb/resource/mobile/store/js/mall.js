// JavaScript Document
$(document).ready(function(e) {
	//积分商城首页图片宽高控制
    $(".exchange_list li .exchange_pro_img").height($(".exchange_list li .exchange_pro_img").width());
	
	//积分商品列表页定位层高度
	 $(".goods_nav").height($(".goods_nav .goods_nav_fixed").height());
	
	//返回头部事件
	$(window).scroll(function(){
		var htmlTop = $(document).scrollTop();
	    console.log(htmlTop);
		if( htmlTop >10){
			$("#backtotop").show();	
		}else{
			$("#backtotop").hide();
		}
	});
    $("#backtotop").click(function(){
		var _this = $(this);
		$('html,body').animate({ scrollTop: 0 }, 500 ,function(){
		
		});
	}); 
	
	//选项卡个数和宽度计算
	$(".tabContainer ul.tabHd li").css("width",$(".tabContainer ul.tabHd").width()/$(".tabContainer ul.tabHd li").length);
});
