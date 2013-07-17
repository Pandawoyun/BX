
<?php include("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php include("includes/header.php");?>

<?php 
	if(isset($_POST['submit'])){
		$email = mysql_prep($_POST['email']);
		$password = mysql_prep($_POST['password']);
		$hashed_password = sha1($password);
		$year = $_POST['year'];
		$errors = array();
		$n = 0;
		$no_empty = array("email","password","year");
		foreach($no_empty as $no){
			if(empty($_POST[$no]) || !isset($_POST[$no])){
				$errors[] = $no;
				$n++;
			}
		}
		//starting messaging
		$message = "<p>";
		if(!empty($errors)){
			foreach($errors as $e){
				$message .=  $e ." ";
			}
			$message .= "can not be empty</p><br>";
		}
		//check the length
		if(strlen(trim($password))>30 || strlen(trim($password))<6){
			$message .= "<p>length of the password should be from 6 to 30</p><br>";
		}
		//check if it's used
		$query = "SELECT * FROM users WHERE email='{$email}' LIMIT 1";
		$result = mysql_query($query,$connection);
		confirm_query($result);
		if(mysql_num_rows($result) == 1){	
			$message .= "<p>Email registered</p><br>";
		}
		//check if it is ok to go
		if($message == "<p>"){
			$query = "INSERT INTO users(email,hashed_password,year) VALUES('{$email}','{$hashed_password}','{$year}')";
			$result = mysql_query($query,$connection);
			confirm_query($result);
			//registered now find his id
			$user = get_user_by_email($email);
			$_SESSION['userid'] = $user['id'];
			$_SESSION['username'] = $user['email'];
			redirect_to("books.php?sell_row=1&buy_row=1");
			//different path
			if($user['year'] == 1){
				redirect_to("buybooks.php?buy_row=1");
			}
			elseif($user['year'] == 8){
				redirect_to("sellbooks.php?sell_row=1");
			}
			else{
				redirect_to("books.php?sell_row=1&buy_row=1");
			}
		}
	}

?>
<?php if(isset($message)){
	echo "{$message}";
} ?>
<form action="creat_users.php" method="post">
	email:<input type="text" name="email" value=""><br>
	password:<input type="password" name="password" value=""><br>
	you are <select name="year">
		<option value="1">pure fresh man</option>
		<option value="2">in 1B term</option>
		<option value="3">in 2A term</option>
		<option value="4">in 2B term</option>
		<option value="5">in 3A term</option>
		<option value="6">in 3B term</option>
		<option value="7">in 4A term</option>
		<option value="8">pure graduating</option>
	</select>
	<input type="submit" name="submit" value="register">
</form>

<?php include("includes/footer.php");?>