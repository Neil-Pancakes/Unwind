



/*WALA pa ni NAHUMAN*/
<?php 
  require("../../functions/sql_connect.php");
  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);
  
  if(count($request>0)){

    $sql = $mysqli->query("SELECT SUBSTRING(`floor_number`+1, 2, LENGTH(`floor_number`)) AS 'number' FROM 'floor'");

    $rs = $sql->fetch_array(MYSQLI_ASSOC);
    $val = $rs["number"];
    if($rs["number"]==""){
      $val = "01";
    }
    $number = $floor.$val;
    $query = "INSERT INTO `room` (`floor_number`) VALUES ('$number');";
    
    $result = mysqli_query($mysqli, $query);
  }else{
      echo "error";
  }
?>