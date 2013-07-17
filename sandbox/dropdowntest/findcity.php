
<?php require_once("../../includes/functions.php");
 		include("../../includes/connection.php");
?>

<?php 

	$country = $_GET['country'] ;
	$query="SELECT city FROM city WHERE countryid={$country}";
	$result=mysql_query($query);
	confirm_query($result);
?>
<select name="city">
<option>Select City</option>

<?php while($row=mysql_fetch_array($result)) { ?>
<option value><?php echo $row['city'];?></option>
<?php } ?>
</select>
