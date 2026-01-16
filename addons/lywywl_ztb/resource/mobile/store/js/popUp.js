// JavaScript Document 

//我的员工页面弹出层
var oMask = document.querySelector('.mask');
var oButton = document.querySelector('.clickBtn');
var oContent = document.querySelector('.mask .content');
var marginTop=-(parseInt(oContent.offsetHeight)/2);
oContent.style.marginTop=marginTop+'px';
oMask.onclick=function(){
	this.style.visibility='hidden'
}
oButton.onclick	=function(){
	oMask.style.visibility='visible'
}