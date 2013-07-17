<html>
<head>
<title>Roshan's Ajax dropdown code</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?
#### Roshan's Ajax dropdown code with php
#### Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
#### if you have any problem contact me at http://roshanbh.com.np
#### fell free to visit my blog http://php-ajax-guru.blogspot.com
?>
<script>
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
	
	
	
	function getCity(strURL) {		
		
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script>




</head>

<body>

<form method="post" action="" name="form1">
<table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="150">Country</td>
    <td  width="150"><select name="country" onChange="getCity('findcity.php?number=2&country='+this.value)">
	<option value="">Select Country</option>
	<option value="1">USA</option>
	<option value="2">Canada</option>
        </select></td>
  </tr>
  <tr style="">
    <td>City</td>
    <td ><div id="citydiv"><select name="city">
	<option>Select City</option>
        </select></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
