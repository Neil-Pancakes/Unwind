<?php
    require("../../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);

    if(count($request>0)){
        $id = $request['id'];
        $employeeId = $_SESSION['employee_id'];
        
        $query = "UPDATE `service_request` 
        SET `service_request_status` = 'Rejected', `employee_id` = $employeeId
        WHERE `service_request_id` = $id";
        $result = mysqli_query($mysqli, $query);
    }
?>
