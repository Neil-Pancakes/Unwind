<?php
    require("../../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);
    session_start();

    if(count($request>0)){
        $id = $request['id'];
        $employeeId = $_SESSION['employee_id'];
        
        $query = "UPDATE `reservation_request` 
        SET `reservation_request_status` = 'Accepted', `employee_id` = $employeeId, `response_time` = NOW()
        WHERE `reservation_request_id` = $id";
        $result = mysqli_query($mysqli, $query);
    }
?>
