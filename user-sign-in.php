<?php

session_start();
include("include/connection.php");
if(isset($_POST['name'])){
    $name = $_POST['name'];
    // echo $name; exit();
    $pass = $_POST['pass'];

    $emp_sql = "SELECT * FROM employee WHERE username='$name' AND password='$pass'";
    $emp_result = $conn->query($emp_sql);
    if($emp_result->num_rows > 0){
        if($emp_row = mysqli_fetch_array($emp_result)){
            echo $emp_row['id'];
            // echo $id;
            
        }
    }
    else{
        echo "Invalid username or Password";
    }
}
?>