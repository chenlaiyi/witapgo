var focusid = '' ;
$("body").keydown(function(event) {
    let key = event.keyCode;
    if(key == 38){
        focusid = 6;
    }else if(key == 37  && focusid !=6){
        if(focusid == 1){
            focusid = 4;
        }else{
            focusid--;
        }
    }else if(key == 39){
        if(focusid == 4){
            focusid = 1;
        }else{
            focusid++;
        }
    }else if( key == 40 && focusid==6){
        if("bdindex" == GPC_do){
            focusid = 1;
        }else if( "bdpeople" == GPC_do ){
            focusid = 1;
        }else if( "bdcheck" == GPC_do ){
            focusid = 2;
        }else if( "bdactivity" == GPC_do ){
            focusid = 3;
        }else if( "bdmoney" == GPC_do ){
            focusid = 4;
        }
    }
    $("#btn_"+focusid).focus();
});
$("#btn_"+focusid).focus();
