<?php include("includes/session.php")?>
<?php include("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php include("includes/header.php");?>

<?php if(!isset($userid)){
	die("I dont know how you get here but plz log in");
}?>

<?php if(isset($_COOKIE['message'])){
	$messagew = $_COOKIE['message'];
	setcookie('message',0,time()-42000);
}?>
<?php 
	$srow = $_GET['sell_row'];
	
?>
<table>
	<td>
		<a href="books.php?sell_row=1&buy_row=1">exchange books for free</a>
	</td>
	<td>
		<a href="buybooks.php?buy_row=1">buy books at the lowest price</a>
	</td>
</table>
<form action="sellbooks.php?sob=s" method="post">
	<table>
	<td>
	<p><?php 		
		if(isset($messagew)){
				echo $messagew;
				
		} 
		
		?>
	</p>
	<h1>books to give out</h1>
		<?php /////////drop down lists to be tested
		echo drop_down_lists($srow,"s");
	?>
	</td>
	</table>
	<input type="submit" name="submit" value="Submit">
</form>


<?php 

		echo "<a href=sellbooks.php?userid=" .urlencode($userid)."&sell_row={$srow}>Add a book</a>"; 

?>


<?php include("includes/footer.php");?>

















