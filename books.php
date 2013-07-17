<?php require_once("includes/session.php")?>
<?php include("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
///////////WHEN USER CLICK THE BUTTON GO VALIDATE THE INFORMATION AND SEE IF THEY PASS
<?php include("includes/header.php");?>
        <body>
        	<div id="header">
        		<h1>My Book Exchange</h1>
        	</div>
        	<div id="main">



<?php if(!isset($userid)){
	die("I dont know how you get here but plz log in");
}?>

<?php if(isset($_COOKIE['messages'])){
	$messages = $_COOKIE['messages'];
	setcookie('messages',0,time()-42000);
}?>


<?php if(isset($_COOKIE['messagew'])){
	$messagew = $_COOKIE['messagew'];
	setcookie('messagew',0,time()-42000);
}?>

<?php
	$brow = $_GET['buy_row'];
	$srow = $_GET['sell_row'];

?>
<table id="structure">
	<tr id="zhu">
	<td id="navigation">
		<li><a href="sellbooks.php?sell_row=1&buy_row=1">sell books to us</a></li>

		<li><a href="buybooks.php?buy_row=1">buy books at the lowest price</a></li>
	</td>

	<td id="books">

	<form name="main_form" method="post" onsubmit="return validateForm()">
	
		<table>
		<td id="sellpart">
		<p><?php
			if(isset($messages)&&($messages!="")){
					echo $messages;
			}

			?>
		</p>
		<h1>books to give out</h1>
		<?php /////////drop down lists to be tested
			echo "<div id=\"divs1\">";
			echo drop_down("s",1);
			echo "</div>"
		?>
		</td>
		<td id="buypart">
		<p><?php
			if(isset($messagew)&&($messagew!="")){
					echo $messagew;

			}
			?></p>
		<h1>books you want</h1>

		<?php
			echo "<div id=\"divw1\">";
			echo drop_down("w",1);
			echo "</div>"
		?>
		</td>
		</table>
		<input name="userid" type="hidden" value=<?php echo $userid?>>
		<input type="submit" name="submit" value="Submit">
	</form>
	<?php ///cookie user choices
		//setcookie("user_choice",)
	?>

	<table>
	<td>
	<?php

		echo "<div id=\"xiaodongwu1\">
		<button type=\"button\" onclick=\"addline('s','addline.php?wos=s&current=')\">Add a book</button>
		<div>";


	?>
	</td>
	<td>
	<?php

		echo "<div id=\"xiaodongwu2\"><button type=\"button\" onclick=\"addline('w','addline.php?wos=w&current=')\">Add a book</button><div>";

	?>
	</td>
	</table>
</td>
</tr>
</table>
<?php include("includes/footer.php");?>

















