<?php
    require("../../functions/sql_connect.php");
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true);

    if(count($request>0)){
        $id = $request['employeeId'];
        
        $query = "UPDATE `employee` 
        SET `isDeleted` = 1
        WHERE `employee_id` = $id";
        $result = mysqli_query($mysqli, $query);
    }
?>