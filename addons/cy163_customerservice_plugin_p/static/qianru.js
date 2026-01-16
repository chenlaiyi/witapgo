var xfdiv = document.createElement("div");
xfdiv.id = "xfkefu";
xfdiv.style['width'] = 40+'px';
xfdiv.style['height'] = 'auto';
xfdiv.style['lineHeight'] = 20+'px';
xfdiv.style['paddingTop'] = 15+'px';
xfdiv.style['paddingBottom'] = 15+'px';
xfdiv.style['paddingRight'] = 10+'px';
xfdiv.style['paddingLeft'] = 10+'px';
xfdiv.style['textAlign'] = 'center';
xfdiv.style['position'] = 'fixed';
xfdiv.style['zIndex'] = 1000;
xfdiv.style['background'] = '#f7c25c';
xfdiv.style['color'] = '#ffffff';
xfdiv.style['cursor'] = 'pointer';
xfdiv.style['fontSize'] = 16+'px';
xfdiv.style['right'] = 0;
xfdiv.innerText = '咨询客服';


var qrdiv = document.createElement("div");
qrdiv.id = "qrkefu";
qrdiv.style['width'] = 600+'px';
qrdiv.style['height'] = 600+'px';
qrdiv.style['position'] = 'fixed';
qrdiv.style['background'] = '#ffffff';
qrdiv.style['zIndex'] = 999;
qrdiv.style['right'] = 90+'px';
qrdiv.style['bottom'] = 20+'px';
qrdiv.style['box-shadow'] = 'rgba(15, 66, 76, 0.25) 0px 0px 16px 0px';
qrdiv.style['display'] = 'none';
var qriframe = document.createElement("iframe");
qriframe.frameborder = 0;
qriframe.id = "kfiframe";
qriframe.name = "kfiframe";
qriframe.style['border'] = 'none';
qriframe.scrolling = "no";
qriframe.style['width'] = 600+'px';
qriframe.style['height'] = 600+'px';
qriframe.style['position'] = 'absolute';
qriframe.style['top'] = 'auto';
qriframe.style['bottom'] = 0;

qrdiv.appendChild(qriframe);
document.body.appendChild(xfdiv);
document.body.appendChild(qrdiv);


document.getElementById("xfkefu").onclick = function(){
	if(document.getElementById("qrkefu").style.display == 'none'){
		document.getElementById("qrkefu").style.display = "block";
	}else{
		document.getElementById("qrkefu").style.display = "none";
	}
};