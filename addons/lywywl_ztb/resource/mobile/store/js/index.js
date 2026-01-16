// JavaScript Document
$(document).ready(function(e) {
    //上传图片关闭事件
    $(".uploaded .upload_close").click(function(e) {
        $(this).parent().hide();
    });

    //限制购买量递增递减
    $(".num_box .plus").click(function(e) {
        var buyNum = parseInt($(this).parent().find('.num_edit input').val()) + 1;
        $(this).parent().find('.num_edit input').val(buyNum);
        $(this).parent().find('.minus').removeClass("minus_un");
    });
    $(".num_box .minus").click(function(e) {
        var buyNum = parseInt($(this).parent().find('.num_edit input').val()) - 1;
        if(buyNum<=0){
            $(this).parent().find('.num_edit input').val(0);
            $(this).addClass("minus_un");
        }else{
            $(this).parent().find('.num_edit input').val(buyNum);
            $(this).removeClass("minus_un");
        }
    });
    $(".num_edit input").keyup(function(e) {
        if($(this).val() <= 0){
            $(this).parents('.num_box').find('.minus').addClass("minus_un");
        }else{
            $(this).parents('.num_box').find('.minus').removeClass("minus_un");
        }
    });
    $(".num_edit input").change(function(e) {
        if($(this).val() <= 0){
            $(this).val(0);
        }
    });
});