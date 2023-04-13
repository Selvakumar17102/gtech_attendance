<?php
include('include/connection.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $sql = "UPDATE employee SET del_status=1 WHERE id=$id";
    $result =$conn->query($sql);
    if($result == TRUE){
        header('location:'.$_SERVER['HTTP_REFERER']);
    }
}
?>