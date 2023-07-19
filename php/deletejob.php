<?php
    include('../function.php');
    $tasks = $_GET['Tasks'];
    $sql = "DELETE FROM `task` WHERE Tasks = '$tasks'";
    $stafftask = $connection->query($sql);
    if ($stafftask) {
        header("location: http://localhost/jobSchedule/Admindash/jobandstatus.php");
    }
?>