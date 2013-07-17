
<?php require_once("includes/session.php")?>
<?php include("includes/connection.php");?>
<?php require_once("includes/functions.php");?>

<?php ///////////////change the header to use the cookie file instead of the POST!

include("includes/header.php");?>

<?php
	//check if it is a valid visit
	if(!isset($userid)){
		redirect_to("index.php");	
	}
?>

<?php 
	$w = $_GET['w'] * 2;
	$s = $_GET["s"] * 2;

	
	
	
?>
<?php 
	//core starts
	
	 $i = 1;
	 $sheet = 'sellingbooks';
	 $wcna = 0;
	 $wcnum = 0;
	 $tosell = 0;
	 $tobuy = 0;
	
	if($w == 0){
		$tosell = 1;
	}
	else if($s == 0){
		$tobuy = 1;
	}
	
	foreach($_POST as $key => $value){
		
		if($key == 'userid'){
			break;
		}
		
		if($i > $s){

			$sheet = 'wishbooks';

			$s = 100000;
		}
		
		if($value != ''){
			if($i%2 != 0){
				$wcna = mysql_prep($value);		
			}
			else{
				$wcnum = $value;		
				insert($sheet,$userid,$wcna,$wcnum,$tobuy,$tosell);
			}
			$i = $i + 1;
		}
		else{
			$i = $i + 2;
		}
	}
	
	echo var_dump($_POST);
	
	
	
?>

<?php include("includes/footer.php");?>