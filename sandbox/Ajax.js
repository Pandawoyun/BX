window.onload = initial;
xhr = false;

function initial(){
	var all = document.getElementByTagName("a");
	////
	var test = document.getElementById("preview");
	test.innerHTML = "yun";
	for(var i=0;i<all.length;i++){
		all[i].onmouseover = showcontent;
	}
}

function showcontent(evt){
	if(evt){
		var url = evt.target;
	}
	else{
		evt = window.event;
		var url = evt.srcElement;
	}
	
	xPos = evt.clientX;
	yPos = evt.clientY;
	
	if(window.XMLHttpRequest){
		xhr = new XMLHttpRequest;
	}
	else{
		try{
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e){}
	}
	//show content
	if (xhr) {
		if(xhr.readystate == 4){
			if(xhr.status == 200){
				var msg = xhr.responseText;
				var tar  = document.getElementById("preview");
				tar.innerHTML = url;
				tar.style.top = parseInt(yPos) + 2 + "px";
				tar.style.left = parseInt(xPos) + 2 + "px";
			}
		}
		xhr.open("GET",url,true);
		xhr.send(null);
	}
	//send
	
	
}