<?php include("includes/session.php")?>
<?php require_once("includes/connection.php");?>
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
	$brow = $_GET['buy_row'];
	
?>

<table>
	<td>
		<a href="sellbooks.php?sell_row=1">sell books to us</a>
	</td>
	<td>
		<a href="books.php?sell_row=1&buy_row=1">exchange books for free</a>
	</td>
</table>
<form action="process.php?buy_row=<?php echo $brow; ?>&sob=b" method="post">
	<table>
	<td>
	<p><?php 		
		if(isset($messagew)){
				echo $messagew;
		}
		?></p>
	<h1>books you want</h1>

	<?php /////////drop down lists to be tested
		echo drop_down_lists($brow,"w");
	?>
	</td>
	</table>
	<input type="submit" name="submit" value="Submit">
</form>



<?php 	

		echo "<a href=buybooks.php?buy_row={$brow}>Add a book</a>"; 

?>


<?php include("includes/footer.php");?>

















