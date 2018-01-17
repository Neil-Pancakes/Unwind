<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  $actual_pic=addslashes($request['picture']);

  if(count($request>0)){
    $position = $request['position'];
    $fn = $request['firstName'];
    $ln = $request['lastName'];
    $mi = $request['mi'];
    $email = $request['email'];
    $bday = $request['birthDate'];
    $gender = $request['gender'];
    $num = $request['contactNo'];
    $pic = $actual_pic;
    
    // $pic = "http://localhost/Unwind/includes/img/".$pic;

    $query = "INSERT INTO `employee` 
    (`position`, `first_name`, `last_name`, `middle_initial`, `email`, `birthdate`, `gender`, 
    `contact_no`, `date_account_created`, `picture`) 
    VALUES 
    ('$position', '$fn', '$ln', '$mi', '$email', '$bday', '$gender', '$num', NOW(), '$pic');";
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>