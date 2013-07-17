<script>

function addline(current,wos,url){
var url = url + 1;
$('#div' + wos + current).after("<div id=\"div" + wos + (current + 1) + "\" >" + url + "<div>");
}


</script>