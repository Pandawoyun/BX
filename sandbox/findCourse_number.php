
<?php require_once("../includes/functions.php");
 		include("../includes/connection.php");
?>

<?php 
	$courseid = $_GET['courseid'] ;
	$wos = $_GET['wos'];
	
	die($courseid);
	$query="SELECT course_number FROM course_number WHERE courseid={$courseid}";
	$result=mysql_query($query);
	confirm_query($result);
?>
<select name=<?php echo "\"{$wos}course_number_{$number}\""; ?>>
<option value="">Select Course number</option>
<?php while($course_number_row=mysql_fetch_array($result)) { ?>
<option><?php echo $course_number_row['course_number'];?></option>
<?php } ?>
</select>
