<?php
include '../connect_db.php';
    $id = $_GET['id'];
    $sql = "UPDATE user SET status_admin = '0' WHERE id = '$id'";
    $query = mysqli_query($con,$sql);
    header('location: ./quanlyuser.php');
?>