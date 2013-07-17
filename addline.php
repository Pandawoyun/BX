
<?php require_once("includes/functions.php");
 		include("includes/connection.php");
?>

<?php 

	$current = $_GET['current'];
	$current++;
	$wos = $_GET['wos'];

	if($wos == 'w'){
		$wos = "w";
	}
	if($wos == 's'){
		$wos = "s";
	}
	
	echo drop_down($wos,$current);
?>
