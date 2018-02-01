<?php
    require("../../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    session_start();

    if(count($request>0)){
        $id = $request['id'];
        
        $query = "UPDATE `check_in` 
        SET `check_in_end` = NOW()
        WHERE `check_in_id` = $id";
        $result = mysqli_query($mysqli, $query);
    }
?>
