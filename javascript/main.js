
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{
			try{
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}

		return xmlhttp;
	}



	function getCourse_number(strURL,num,wos) {

		var req = getXMLHTTP();

		if (req) {

			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementById('course_numberdiv'+ wos + num).innerHTML=req.responseText;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}
			req.open("GET", strURL, true);
			req.send(null);
		}

	}
	var currentw = 1;
	var currents = 1;
	function addline(wos,url) {
		if(wos == 's'){

			var current = currents;
			url = url + currents;
			currents++;

		}
		else{

			var current = currentw;
			url = url + currentw;
			currentw++;

		}

		$('#div' + wos + current).after("<div id=\"div" + wos + (current + 1) + "\" > empty <div>");
		current = current + 1;
		var req = getXMLHTTP();

		if (req) {

			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
						document.getElementById("div" + wos+ current).innerHTML=req.responseText;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}
			}

			req.open("GET", url, true);
			req.send(null);
		}

	}


	function getPost(wos,non,num){
		if(non == "number"){
			return document.forms["main_form"][wos + "course_number_" + num].value;
		}
		else{
			return document.forms["main_form"][wos + "course_name_" + num].value;
		
		}
	}
	
	var msg = new Array();
	function validateForm()
	{


		var pass = true;
		for(var i=1;i <= currents;i++){
			if(getPost("s","name",i) != '' && getPost("s","number",i) == ''){
				pass = false;
				msg["msgs" + i] = "please fill in the course number here";
			}
		}
		
		for(var i=1;i <= currentw;i++){
			if(getPost("w","name",i) != '' && getPost("w","number",i) == ''){
				pass = false;
				msg["msgw" + i] = "plea se fill in the course number here";
			}
		}
		
		for(var key in msg){
			document.getElementById(key).innerHTML=msg[key];
		}
		
		document.main_form.action ="process.php?w=" + currentw + "&s=" + currents;
		

		return pass;
	  
	}
function elemsg(wos,num,value){
	var w = null;
	
	if(value != ""){
		msg = [];
		document.getElementById('msg' + wos + num).innerHTML="";
	}

}
function action(){
	return "process.php?s=" + currents + "?w=" + currentw;

}
