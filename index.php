<?php session_start();
?>
<?php include("includes/connection.php");?>
<?php require_once("includes/functions.php");
	if(isset($_SESSION['userid'])){
		redirect_to('books.php?sell_row=1&buy_row=1');
	}
?>
<?php include("includes/header.php");?>
<?php 
	if(isset($_POST['submit'])){
		$email = mysql_prep($_POST['email']);
		$password = mysql_prep($_POST['password']);
		$hashed_password = sha1($password);
		
		$query = "SELECT * FROM ";
		$query .="users WHERE ";
		$query .="email='{$email}' ";
		$query .= "AND hashed_password='{$hashed_password}'";
		
		$result_set = mysql_query($query,$connection);
		confirm_query($result_set);
		
		if(mysql_num_rows($result_set) == 1){
			$found_user = mysql_fetch_array($result_set);
			
			$_SESSION['userid'] = $found_user['id'];
			$_SESSION['username'] = $found_user['email'];
			if($found_user['year'] == 1){
				redirect_to("buybooks.php?buy_row=1");
			}
			elseif($found_user['year'] == 8){
				redirect_to("sellbooks.php?sell_row=1");
			}
			else{
				redirect_to("books.php?sell_row=1&buy_row=1");
			}
		}
		else{
			$message = "There is no such user in here";
		}
	}
?>

<?php if(isset($message)){
		echo "<p>{$message}</p><br>";
		}
?>
<form action="index.php" method="post">
email: <input type="text" name="email" value="">
password:<input type="password" name="password" value="">
<input type="submit" name="submit" value="Login"> 
</form>
<a href="creat_users.php">register</a>

<?php include("includes/footer.php");?>