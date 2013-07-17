<?php include("../includes/connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php include("../includes/header.php");?>


<?php 
$wosjava = "'s'";
echo "<select onchange=\"getCourse_number('findCourse_number.php?wos={$wosjava}&number=&courseid=' + this.value,{$wosjava})\">";?>

<?php include("../includes/footer.php");?>