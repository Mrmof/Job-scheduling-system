<?php
    include('../function.php');
    $staffemail = $_GET['email'];
    $staffdata = "DELETE FROM `staff` WHERE email = '$staffemail'";
    $sql = $connection->query($staffdata);
    if ($sql) {
        header("location: http://localhost/jobSchedule/Admindash/index.php");
    }
?>