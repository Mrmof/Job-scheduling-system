<?php
include('../function.php');
if (isset($_POST['assigntask'])){
    checksign();
    assignTask();
    
}
// $dat = new Datetime($_POST['due_date']);
// // $date = date_format($dat, 'Y-m-d');
// // echo $dat;
// // // echo date_create($_POST['due_date']);
// $currentsate = new Datetime();
// // echo $currentsate;
// $duration = date_diff($currentsate, $dat);
// echo $duration->format('%a');

// $dat =$_POST['due_date'];
// $date =  date_create($_POST['due_date']);
// echo $date->format('Y-m-d');
// $da = date('Y-m-d');
// $currentsate = date_create($da);
// // echo $currentsate;
// echo $currentsate->format('Y-m-d');
// $dt = date_diff($currentsate, $date);
// echo $duration = $dt->format('%d'); ../Admindash/img/task/123589e9d8e1bef53ede95e385d52d7a1a5a.pdf
?>