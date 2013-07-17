   
<!DOCTYPE html>
<html>
<head>
<style>
div { color:red; }
</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
function woyun(val){
	$("div").text(val);
}</script>
</head>
<body>
<table>
<select class="woyun" name="sweets" multiple="multiple" onchange="woyun(this.value)">
<option>Chocolate</option>
<option selected="selected">Candy</option>
<option>Taffy</option>
<option selected="selected">Caramel</option>
<option>Fudge</option>
<option>Cookie</option>
</select>
<div></div>
<script>
$("select").change(woyun())
.change();
</script>
</table>
  
<table>
<select class="woyun" name="sweets" multiple="multiple" onchange="woyun('woyun'+this.value,2)">
<option>Chocolate</option>
<option selected="selected">Candy</option>
<option>Taffy</option>
<option selected="selected">Caramel</option>
<option>Fudge</option>
<option>Cookie</option>
</select>
<div></div>
<script>
$("select.{$name}").change(woyun(this.value))
.change();
</script>
</table>
</body>
</html>