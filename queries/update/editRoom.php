<?php
    require("../../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);

    if(count($request>0)){
        $id = $request['id'];
        $number = $request['number'];
        $status = $request['status'];
        
        $query = "UPDATE `room` 
        SET `room_number` = '$number', `room_status` = '$status'
        WHERE `room_id` = $id";
        echo $query;
        $result = mysqli_query($mysqli, $query);
        echo $result;
    }
?>
