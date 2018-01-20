
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require("../../functions/sql_connect.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
if(count($request>0)){
	$result = $mysqli->query("SELECT `password`
	FROM `user_account`
	WHERE `email`='".$request["email"]."'");
	if(count($result->fetch_array(MYSQLI_ASSOC))==0){
		$password=md5($request["password"]);
		$fn=$request["firstName"];
		$mi=$request["middleInitial"];
		$ln=$request["lastName"];
		$email=$request["email"];
		$num=$request["contactNo"];
		$gender=$request["gender"];
		$bday=$request["birthDate"];
    // $pic = "http://localhost/Unwind/includes/img/".$pic;
	    $query = "INSERT INTO `user_account` 
	    (`password`,`first_name`, `last_name`, `middle_initial`, `email`, `birthdate`, `gender`, 
	    `contact_no`, `date_account_created`) 
	    VALUES 
	    ('$password','$fn', '$ln', '$mi', '$email', '$bday', '$gender', '$num', NOW())";
	    $result = mysqli_query($mysqli, $query);
    }else{
    	echo "Username already Exists";
    }
  }else{
      echo "error";
  }
$mysqli->close();
?>