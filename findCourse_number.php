
<?php require_once("includes/functions.php");
 		include("includes/connection.php");
?>

<?php
	$courseid = $_GET['courseid'] ;
	$number = $_GET['number'];
	$wos = $_GET['wos'];



	$query="SELECT course_number FROM course_number WHERE courseid={$courseid}";
	$result=mysql_query($query);
	confirm_query($result);
?>

<select name=<?php echo "\"{$wos}course_number_{$number}\""; ?> onchange="elemsg(<?php echo ($wos == "w" ? "'w'" : "'s'"); ?>,<?php echo $number;?>,this.value)">
<option value="">Select Course number</option>
<?php while($course_number_row=mysql_fetch_array($result)) { ?>
<option><?php echo $course_number_row['course_number'];?></option>
<?php } ?>
</select>
