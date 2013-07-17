<?php
	function mysql_prep($value){
		$magic = get_magic_quotes_gpc();
		$new = function_exists("mysql_real_escape_string");
		if($new){
			if($magic){
				$value = stripslashes($value);
			}
			$value = mysql_real_escape_string($value);
		}
		else{
			if($magic){
				$value = addslashes($value);
			}
		}
		return $value;
	}

	function redirect_to($L){
		header("Location:".$L);
		exit;
	}

	function confirm_query($result_set){
		if(!$result_set){
			die("Database query failed:".mysql_error());
		}
	}

	function get_user_by_email($email){
		global $connection;
		$query = "SELECT * FROM users WHERE email='{$email}' LIMIT 1";
		$result = mysql_query($query,$connection);
		confirm_query($result);
		$user = mysql_fetch_array($result);
		return $user;
	}

	function insert($sheet,$userid,$coursename,$coursenumber,$sell,$buy){
		$query = "INSERT INTO {$sheet}(user_id,course_name,course_number,tosell,tobuy) VALUES({$userid},'{$coursename}',{$coursenumber},{$sell},{$buy})";
		$result = mysql_query($query);
		confirm_query($result);


	}



	function validate($wos,$userid,$rows){
	//validating wanted books
	$warray = array();
	$messagew = "";
	$nthbookw = 1;

	$waose = ($wos == "w" ? "wanted" : "selling");
	while(($nthbookw-1)<=$rows){

		$course_name = $_POST[$wos.'course_name_'.$nthbookw];
		$course_number = $_POST[$wos.'course_number_'.$nthbookw];

		if(isset($course_name) && $course_name != "" && isset($course_number) && $course_number != ""){
			$warray[$wos.'course_name_'.$nthbookw] =  $course_name;
			$warray[$wos.'course_number_'.$nthbookw] =  $course_number;
		}

		elseif((!isset($course_name) || $course_name == "") && (!isset($course_number) || $course_number == "")){
			$nthbookw++;
			continue;
		}

		elseif(!isset($course_name) || $course_name == ""){
			$messagew .= "please fill in the course name of {$waose} book number {$nthbookw}<br><p>";
		}
		elseif(!isset($course_number) || $course_number == ""){
			$messagew .= "please fill in the course number of {$waose} book number {$nthbookw}<br><p>";
		}
		else{
			echo "ERROR here is wrrrrrrrong functions.php/line 77";
		}
		$nthbookw++;
	}

	if(($nthbookw - 1)== 0){
		$messagew .= "at least fill in something";

	}
	//valid information then...insert them into database
	if($messagew==""){
		//cuz nthbooks are added one more we are deducting one
		$nthbookw--;

		$inthw = 1;
		if($wos == 'w'){
			$sheet = 'wishbooks';
		}
		else{
			$sheet = 'sellingbooks';
		}
		while($inthw<=$nthbookw){
			$wcna = mysql_prep($warray[$wos.'course_name_'.$inthw]);
			$wcnum = $warray[$wos.'course_number_'.$inthw];
			insert($sheet,$userid,$wcna,$wcnum,0,1);
			$inthw++;
		}
	}
	else
		return $messagew;
}


 //check if there is a userid in here
 function logged_in_info(){
	if(!isset($_SESSION['userid'])){
		redirect_to('index.php');
	}
 }



 function drop_down($wos,$current){

 	$query="SELECT * FROM course";
 	$result=mysql_query($query);
 	confirm_query($result);
 	$course_arr = array();

 	while($course_name_row=mysql_fetch_array($result)){
 		$courseid = $course_name_row['id'];
 		$course_arr[$courseid] = $course_name_row['course_name'];
 	}
 	$count = sizeof($course_arr);



 	$output = "";
 	$wosjava = ($wos == "s" ? "'s'" : "'w'");

 		$name = "{$wos}course_name_{$current}";


 		$output .= "<table >";
 		$output .= "<tr>";
 		$output .= "<td>";
     $output .= "<select name=\"{$wos}course_name_{$current}\" onchange=\"if(this.value != ''){getCourse_number('findCourse_number.php?wos={$wos}&number={$current}&courseid=' + this.value,{$current},{$wosjava})}else{
 document.getElementById('course_numberdiv{$wos}{$current}').innerHTML=''}\">";
 		$output .= "<option value=\"\">Select course</option>";

 		$counter = 1;
 		while($counter <= $count) {
 			$output .= "<option value=\"{$counter}\" >{$course_arr[$counter]}</option>";
 			$counter++;
 		}

 		$output .= "</select>";
 		$output .= "</td>";


 		$output .= "<td>";
 		$output .= "<div id=\"course_numberdiv{$wos}{$current}\"></div>";
 		$output .= "</td>";
 		
 		$output .=	"<td><div id=\"msg{$wos}{$current}\"></div></td>";
 		$output .= "</tr>";
 		$output .= "</table>";

 		$current++;



 	return $output;
 }
?>


