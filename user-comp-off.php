<?php

include('include/connection.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $date = $_POST['date'];
    $range = $_POST['range'];
    $fnan_status = $_POST['fnan_status'];

    if($id != 0){
        if($date != null){
            $comp_sql = "SELECT * FROM comp_off WHERE emp_id='$id' AND date='$date'";
            $comp_result = $conn->query($comp_sql);
            if($comp_result->num_rows > 0){
                if($range == 1){
                    $fnan_status = 0;
                }
                $comp_sql1 = "UPDATE comp_off SET count='$range', fn_an_status='$fnan_status' WHERE emp_id='$id' AND date='$date'";
                if($conn->query($comp_sql1) == TRUE){
                    echo "Comp Off Updated";
                }
            }
            else{
                if($range == 1){
                    $fnan_status = 0;
                }
                $comp_sql2 = "INSERT INTO comp_off (emp_id, date, count, fn_an_status) VALUES ('$id', '$date', '$range', '$fnan_status')";
                if($conn->query($comp_sql2) == TRUE){
                    echo "Comp Off Added";
                }
            }
        }
        else{
            echo "Enter Date";
        }
    }
    else{
        echo "Enter Name";
    }
}
?>