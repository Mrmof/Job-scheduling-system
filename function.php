<?php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'job_schedule';

 $connection = new mysqli($host, $username, $password, $database);
// if ($connection) {
//     echo "connected successfully";
// } else {
//     echo connection_error();
// }

define("ROOT_URL", 'http://localhost/jobSchedule/');

function signup(){
    global $connection;
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
    $companyname = filter_var($_POST['comp_name'], FILTER_SANITIZE_STRING);
    $compandesc = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $specials = array('.','/',';','-','_','$');
    $fullname = str_replace($specials, "", $fullname);
    $companyname = str_replace($specials, "", $companyname);
    if (strlen($fullname) < 6 || strlen($companyname) < 6 || strlen($compandesc) < 10) {
        $_SESSION['message'] = 'Please enter valid details (atleast 6 character length)';
        echo "<script> window.history.back()</script>";
    } elseif (strlen($password) < 7) {
        $_SESSION['message'] = 'Please enter your password (atleast 7 character length)';
        echo '<script> window.history.back()</script>';
    } elseif ($password != $cpassword) {
        $_SESSION['message'] = 'Password mismatch';
        echo '<script> window.history.back()</script>';
    }else {
        $adminsreg = "INSERT INTO `admins`(`fullname`, `companyname`, `companydesc`, `email`, `password`, `cpassword`) VALUES ('$fullname','$companyname','$compandesc','$email','$password','$cpassword')";
        $sql = $connection->query($adminsreg);
        if ($sql) {
           header("location: http://localhost/jobSchedule/signin.php");
        }else{
            // echo 'error';
        }
    }

}

function signin(){
    global $connection;
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $check = "SELECT * FROM `admins` WHERE email = '$email'";
    $sql = $connection->query($check);
    if ($sql->num_rows > 0) {
        $row = $sql->fetch_assoc();
        if ($password != $row['password']) {
            $_SESSION['message'] = 'Please input your correct login details';
            echo '<script> window.history.back()</script>';
        }else{
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            header("location: http://localhost/jobSchedule/Admindash/index.php?id=".$_SESSION['id']);
        }
    }else{
        $checkstaff = "SELECT * FROM `staff` WHERE email = '$email'";
        $sqlstaff = $connection->query($checkstaff);
        if ($sqlstaff->num_rows > 0) {
            $row1 = $sqlstaff->fetch_assoc();
                echo $row1['password'];
                echo $password;
                echo $email;
            if ($password != $row1['password']) {
                $_SESSION['message'] = 'Please input your correct login details';
                echo '<script> window.history.back()</script>';
            }else{
                $_SESSION['email'] = $row1['email'];
                $_SESSION['id'] = $row1['count'];
                header("location: http://localhost/jobSchedule/userdash/index.php?id=".$_SESSION['id']);
            }
        }
    }
}
function checksign(){
        $admin_id = $_SESSION['id'];
        return $admin_id;   
}
function checkusersign(){
    $user_id = $_SESSION['id'];
    return $user_id;   
}

function checkuseremail(){
$user_email = $_SESSION['email'];
return $user_email;   
}
function addstaff(){
    global $connection;
    $admin_id = checksign();
    echo $admin_id;
    $staffname = filter_var($_POST['staffname'], FILTER_SANITIZE_STRING);
    $competency = filter_var($_POST['competency'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $study= filter_var($_POST['study'], FILTER_SANITIZE_STRING);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $specials = array('.','/',';','-','_','$');
    $staffname = str_replace($specials, "", $staffname);
    $competency = str_replace($specials, "", $competency);
    if (strlen($staffname) < 6) {
        $_SESSION['message'] = 'Enter staff fullname';
        echo '<script> window.history.back()</script>';
    }elseif ($competency == '') {
        $_SESSION['message'] = 'Please choose staff competency level';
        echo '<script> window.history.back()</script>';
    }elseif ($study == '') {
        $_SESSION['message'] = 'Please choose staff field of study';
        echo '<script> window.history.back()</script>';
    }elseif (Strlen($password) < 6) {
        $_SESSION['message'] = 'Enter password (min. 6 character)';
        echo '<script> window.history.back()</script>';
    } elseif ($password != $cpassword) {
        $_SESSION['message'] = 'Password mismatch';
        echo '<script> window.history.back()</script>';
    }else{
        $addstaff="INSERT INTO `staff`(`staff_name`, `compentency`, `email`, `study`, `role`, `password`, `cpassword`, `admin_id`) VALUES ('$staffname','$competency','$email','$study','$role','$password','$cpassword','$admin_id')";
        $sql = $connection->query($addstaff);
        if ($sql) {
            $recorddate = date('Y-m-d');
            $details = $staffname .' was added as a staff';
            $record = "INSERT INTO `history`(`details`, `name`, `history_date`, `admin_id`) VALUES ('$details','$staffname','$recorddate','$admin_id')";
            $history = $connection->query($record);
            if($history){
                header("location: http://localhost/jobSchedule/Admindash/staff.php"); 
            }
        }
    }
}

function querystaffdata(){ 
    $admin_id = checksign();
    global $connection;
    $staffdata = "SELECT * FROM `staff` WHERE admin_id = '$admin_id'";
    global $sql;
    $sql = $connection->query($staffdata);
}
// query individual staff data
function querysinglestaffdata(){ 
    $user_id = checkusersign();
    global $connection;
    $staffdata = "SELECT * FROM `staff` WHERE count = '$user_id'";
    global $sql;
    $sql = $connection->query($staffdata);
}
function countstaff(){
    $admin_id = checksign();
    global $connection;
    $staffdata = "SELECT * FROM `staff` WHERE admin_id = '$admin_id'";
    global $sql;
    $sql = $connection->query($staffdata);
    $staffcount =$sql->num_rows;  
    return $staffcount;
}


function editstaff(){
    global $connection;
    $admin_id = checksign();
    // echo $admin_id;
    $staffname = filter_var($_POST['staffname'], FILTER_SANITIZE_STRING);
    $competency = filter_var($_POST['competency'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $study= filter_var($_POST['study'], FILTER_SANITIZE_STRING);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $specials = array('.','/',';','-','_','$');
    $staffname = str_replace($specials, "", $staffname);
    $competency = str_replace($specials, "", $competency);
    if (strlen($staffname) < 6) {
        $_SESSION['message'] = 'Enter staff fullname';
        echo '<script> window.history.back()</script>';
    }elseif ($competency == '') {
        $_SESSION['message'] = 'Please choose staff competency level';
        echo '<script> window.history.back()</script>';
    }elseif ($study == '') {
        $_SESSION['message'] = 'Please choose staff field of study';
        echo '<script> window.history.back()</script>';
    }elseif (Strlen($password) < 6) {
        $_SESSION['message'] = 'Enter password (min. 6 character)';
        echo '<script> window.history.back()</script>';
    } elseif ($password != $cpassword) {
        $_SESSION['message'] = 'Password mismatch';
        echo '<script> window.history.back()</script>';
    }else{
        $addstaff="UPDATE `staff` SET `staff_name`='$staffname',`compentency`='$competency',`email`='$email',`study`='$study',`role`='$role',`password`='$password',`cpassword`='$cpassword' WHERE email = '$email'";
        $sql = $connection->query($addstaff);
        if ($sql) {
            $recorddate = date('Y-m-d');
            $details = $staffname .' record was updated';
            $record = "INSERT INTO `history`(`details`, `name`, `history_date`, `admin_id`) VALUES ('$details','$staffname','$recorddate','$admin_id')";
            $history = $connection->query($record);
            if($history){
                $_SESSION['notification'] = 'Staff detail updated successfully';
                header("location: http://localhost/jobSchedule/Admindash/staffedit.php?email=".$email);
            }
            
        }else{
            echo 'no';
        }
    }
}

function assignTask(){
    global $connection;
    $admin_id = checksign();
    // echo $admin_id;
    $filedirectory = "../Admindash/img/task/";
    // Admindash\img\task
    $filename = basename($_FILES['file']['name']);
    $target_file = $filedirectory.$filename;
    $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $filesize = $_FILES['file']['size'];
    $competency = filter_var($_POST['competency'], FILTER_SANITIZE_STRING);
    $study= filter_var($_POST['study'], FILTER_SANITIZE_STRING);
    $due_date = date_create($_POST['due_date']);
    $da = date('Y-m-d');
    $currentsate = date_create($da);
    $dt = date_diff($currentsate, $due_date);
    $duration = $dt->format('%d');
    // echo $competency;
    // echo $duration;
    if(file_exists($target_file)) {
        $_SESSION['message'] = 'File already exist in directory. Please change file name';
        echo '<script> window.history.back()</script>';
    }elseif($filesize > 5000000) {
        $_SESSION['message'] = 'File too large (max. size 5mb)';
        echo '<script> window.history.back()</script>';
    }elseif($filetype != 'jpg' && $filetype != 'pdf') {
        $_SESSION['message'] = 'Invalid file type';
        echo '<script> window.history.back()</script>';
    }elseif($competency == '') {
        $_SESSION['message'] = 'Please choose staff competency level';
        echo '<script> window.history.back()</script>';
    }elseif($study == '') {
        $_SESSION['message'] = 'Please choose staff field of study';
        echo '<script> window.history.back()</script>';
    }elseif($duration < 0 || $due_date == '') {
        $_SESSION['message'] = 'Timeframe too short';
        echo '<script>window.history.back()</script>';
    }else {
        $staffdata = "SELECT * FROM `staff` WHERE study = '$study' AND admin_id = '$admin_id'";
        $sql = $connection->query($staffdata);
        if ($sql == true) {
            while ($row = $sql->fetch_assoc()) { #here it runs loop for all array with similar study
                if ($row['compentency'] == 'advanced') {
                    $searchtask = "SELECT * FROM `task`";
                    $sql1 = $connection->query($searchtask);
                    $staffname = $row["staff_name"];
                    $realduedate = $due_date->format('Y-m-d');
                    $realcurrentdate = $currentsate->format('Y-m-d');
                    $status= 'Running';
                    if ($sql1->num_rows < 1) {
                        $assigning = "INSERT INTO `task`(`Staff_name`, `date`, `duration`, `due_date`, `email`, `compentency`, `study`, `img`,`status`, `admin_id`) VALUES ('$staffname', '$realcurrentdate', '$duration', '$realduedate', '" . $row["email"] . "', '" . $row["compentency"] . "', '" . $row["study"] . "', '$target_file', '$status', " . $row["admin_id"] . ")";
                        $sql2 = $connection->query($assigning);
                        move_uploaded_file($_FILES['file']['tmp_name'], $target_file);

                        $recorddate = date('Y-m-d');
                        $details = 'A task was assigned to '.$staffname;
                        $record = "INSERT INTO `history`(`details`, `name`, `history_date`, `admin_id`) VALUES ('$details','$staffname','$recorddate','$admin_id')";
                        $history = $connection->query($record);
                        if($history){
                            $_SESSION['notification'] = 'Task assigned successfully';
                            header("location: http://localhost/jobSchedule/Admindash/jobscheduling.php");
                        } 
                    }else{
                        $row1 = $sql1->fetch_assoc();
                        if ($realcurrentdate > $row1['due_date']) {
                                $assigning = "INSERT INTO `task`(`Staff_name`, `date`, `duration`, `due_date`, `email`, `compentency`, `study`, `img`, `status`, `admin_id`) VALUES ('$staffname', '$realcurrentdate', '$duration', '$realduedate', '" . $row["email"] . "', '" . $row["compentency"] . "', '" . $row["study"] . "', '$target_file', '$status', " . $row["admin_id"] . ")";
                                $sql2 = $connection->query($assigning);
                                move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
                               
                                $recorddate = date('Y-m-d');
                                $details = 'A task was assigned to '.$staffname;
                                $record = "INSERT INTO `history`(`details`, `name`, `history_date`, `admin_id`) VALUES ('$details','$staffname','$recorddate','$admin_id')";
                                $history = $connection->query($record);
                                if($history){
                                    $_SESSION['notification'] = 'Task assigned successfully';
                                    header("location: http://localhost/jobSchedule/Admindash/jobscheduling.php");
                                } 
                            }else{
                                $_SESSION['notification'] = "No available staff";
                                // echo $_SESSION['Message'];
                            }
                    }
                }elseif ($row['compentency'] == 'intermediate') {
                    $searchtask = "SELECT * FROM `task`";
                    $sql1 = $connection->query($searchtask);
                    $staffname = $row["staff_name"];
                    $realduedate = $due_date->format('Y-m-d');
                    $realcurrentdate = $currentsate->format('Y-m-d');
                    
                    if ($sql1->num_rows < 1) {
                        $assigning = "INSERT INTO `task`(`Staff_name`, `date`, `duration`, `due_date`, `email`, `compentency`, `study`, `img`, `status`, `admin_id`) VALUES ('$staffname', '$realcurrentdate', '$duration', '$realduedate', '" . $row["email"] . "', '" . $row["compentency"] . "', '" . $row["study"] . "', '$target_file', '$status', " . $row["admin_id"] . ")";
                        $sql2 = $connection->query($assigning);
                        move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
                        $recorddate = date('Y-m-d');
                        $details = 'A task was assigned to '.$staffname;
                        $record = "INSERT INTO `history`(`details`, `name`, `history_date`, `admin_id`) VALUES ('$details','$staffname','$recorddate','$admin_id')";
                        $history = $connection->query($record);
                        if($history){
                          $_SESSION['notification'] = 'Task assigned successfully';
                         header("location: http://localhost/jobSchedule/Admindash/jobscheduling.php");
                        } 
                    }else{
                        $row1 = $sql1->fetch_assoc();
                        if ($realcurrentdate > $row1['due_date']) {
                                $assigning = "INSERT INTO `task`(`Staff_name`, `date`, `duration`, `due_date`, `email`, `compentency`, `study`, `img`, `status`, `admin_id`) VALUES ('$staffname', '$realcurrentdate', '$duration', '$realduedate', '" . $row["email"] . "', '" . $row["compentency"] . "', '" . $row["study"] . "', '$target_file', '$status'," . $row["admin_id"] . ")";
                                $sql2 = $connection->query($assigning);
                                move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
                                
                                $recorddate = date('Y-m-d');
                                $details = 'A task was assigned to '.$staffname;
                                $record = "INSERT INTO `history`(`details`, `name`, `history_date`, `admin_id`) VALUES ('$details','$staffname','$recorddate','$admin_id')";
                                $history = $connection->query($record);
                                if($history){
                                    $_SESSION['notification'] = 'Task assigned successfully';
                                    header("location: http://localhost/jobSchedule/Admindash/jobscheduling.php");
                                } 
                            }else{
                                $_SESSION['notification'] = "No available staff";
                                // echo $_SESSION['Message'];
                            }
                    }
                }elseif ($row['compentency'] == 'novice') {
                    $searchtask = "SELECT * FROM `task`";
                    $sql1 = $connection->query($searchtask);
                    $staffname = $row["staff_name"];
                    $realduedate = $due_date->format('Y-m-d');
                    $realcurrentdate = $currentsate->format('Y-m-d');
                    if ($sql1->num_rows < 1) {
                        $assigning = "INSERT INTO `task`(`Staff_name`, `date`, `duration`, `due_date`, `email`, `compentency`, `study`, `img`, `status`, `admin_id`) VALUES ('$staffname', '$realcurrentdate', '$duration', '$realduedate', '" . $row["email"] . "', '" . $row["compentency"] . "', '" . $row["study"] . "', '$target_file', '$status', " . $row["admin_id"] . ")";
                        $sql2 = $connection->query($assigning);
                        move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
                        
                        $recorddate = date('Y-m-d');
                         $details = 'A task was assigned to '.$staffname;
                         $record = "INSERT INTO `history`(`details`, `name`, `history_date`, `admin_id`) VALUES ('$details','$staffname','$recorddate','$admin_id')";
                          $history = $connection->query($record);
                        if($history){
                          $_SESSION['notification'] = 'Task assigned successfully';
                           header("location: http://localhost/jobSchedule/Admindash/jobscheduling.php");
                         } 
                    }else{
                        $row1 = $sql1->fetch_assoc();
                        if ($realcurrentdate > $row1['due_date']) {
                                $assigning = "INSERT INTO `task`(`Staff_name`, `date`, `duration`, `due_date`, `email`, `compentency`, `study`, `img`, `status`, `admin_id`) VALUES ('$staffname', '$realcurrentdate', '$duration', '$realduedate', '" . $row["email"] . "', '" . $row["compentency"] . "', '" . $row["study"] . "', '$target_file', '$status', " . $row["admin_id"] . ")";
                                $sql2 = $connection->query($assigning);
                                move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
                                $recorddate = date('Y-m-d');
                                $details = 'A task was assigned to '.$staffname;
                                $record = "INSERT INTO `history`(`details`, `name`, `history_date`, `admin_id`) VALUES ('$details','$staffname','$recorddate','$admin_id')";
                                $history = $connection->query($record);
                                if($history){
                                    $_SESSION['notification'] = 'Task assigned successfully';
                                    header("location: http://localhost/jobSchedule/Admindash/jobscheduling.php");
                                } 
                            }else{
                                $_SESSION['notification'] = "No available staff";
                                // echo $_SESSION['Message'];
                            }
                    }
                 }else {
                    $searchtask = "SELECT * FROM `task`";
                    $sql1 = $connection->query($searchtask);
                    $staffname = $row["staff_name"];
                    $realduedate = $due_date->format('Y-m-d');
                    $realcurrentdate = $currentsate->format('Y-m-d');
                    if ($sql1->num_rows < 1) {
                        $assigning = "INSERT INTO `task`(`Staff_name`, `date`, `duration`, `due_date`, `email`, `compentency`, `study`, `img`, `status`, `admin_id`) VALUES ('$staffname', '$realcurrentdate', '$duration', '$realduedate', '" . $row["email"] . "', '" . $row["compentency"] . "', '" . $row["study"] . "', '$target_file', '$status', " . $row["admin_id"] . ")";
                        $sql2 = $connection->query($assigning);
                        move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
                        $recorddate = date('Y-m-d');
                        $details = 'A task was assigned to '.$staffname;
                         $record = "INSERT INTO `history`(`details`, `name`, `history_date`, `admin_id`) VALUES ('$details','$staffname','$recorddate','$admin_id')";
                         $history = $connection->query($record);
                         if($history){
                         $_SESSION['notification'] = 'Task assigned successfully';
                          header("location: http://localhost/jobSchedule/Admindash/jobscheduling.php");
                        } 
                    }else{
                        $row1 = $sql1->fetch_assoc();
                        if ($realcurrentdate > $row1['due_date']) {
                                $assigning = "INSERT INTO `task`(`Staff_name`, `date`, `duration`, `due_date`, `email`, `compentency`, `study`, `img`, `status`, `admin_id`) VALUES ('$staffname', '$realcurrentdate', '$duration', '$realduedate', '" . $row["email"] . "', '" . $row["compentency"] . "', '" . $row["study"] . "', '$target_file', '$status', " . $row["admin_id"] . ")";
                                $sql2 = $connection->query($assigning);
                                move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
                                $recorddate = date('Y-m-d');
                                $details = 'A task was assigned to '.$staffname;
                                $record = "INSERT INTO `history`(`details`, `name`, `history_date`, `admin_id`) VALUES ('$details','$staffname','$recorddate','$admin_id')";
                                $history = $connection->query($record);
                                if($history){
                                    $_SESSION['notification'] = 'Task assigned successfully';
                                    header("location: http://localhost/jobSchedule/Admindash/jobscheduling.php");
                                } 
                            }else{
                                $_SESSION['notification'] = "No available staff";
                                // echo $_SESSION['Message'];
                            }
                    }
                 }
            if ($sql->num_rows > 1) {
            exit();
            }
            }
        }else {
            echo 'no';
        }
    }
}
function revealtask(){
    global $connection;
    $admin_id = checksign();
    $taskdata = "SELECT * FROM `task` WHERE admin_id = '$admin_id'";
    global $sql;
    $sql = $connection->query($taskdata);
    // $allcountedtask = $sql->num_rows();
    function running(){
        global $connection;
        $admin_id = checksign();
        $runningtask = "SELECT * FROM `task` WHERE admin_id = '$admin_id' AND status = 'Running'";
        $counter = $connection->query($runningtask);
        $running = $counter->num_rows;
        return $running;
    }
    function completed(){
        global $connection;
        $admin_id = checksign();
        $completedtask = "SELECT * FROM `task` WHERE admin_id = '$admin_id' AND status = 'Completed'";
        $counter = $connection->query($completedtask);
        $completed = $counter->num_rows;
        return $completed;
    } 
}

function history(){
    global $connection;
    $admin_id = checksign();
    $sql = "SELECT * FROM `history` WHERE admin_id = '$admin_id'";
    global $history;
    $history = $connection->query($sql);
} 

function notsignedin(){
    if (!isset($_SESSION['id'])) {
        header("location: http://localhost/jobSchedule/signin.php");
    }
}
function usertaskcount(){
    $user_email = checkuseremail();
    global $connection;
    $usertaskcount = "SELECT * FROM `task` WHERE email = '$user_email'";
    $sql = $connection->query($usertaskcount);
    $taskcount =$sql->num_rows;  
    return $taskcount;
}

function revealstafftask(){
    global $connection;
    $user_email = checkuseremail();
    $taskdata = "SELECT * FROM `task` WHERE email = '$user_email'";
    global $sql;
    $sql = $connection->query($taskdata);
    // $allcountedtask = $sql->num_rows();
    function running(){
        global $connection;
        $user_email = checkuseremail();
        $runningtask = "SELECT * FROM `task` WHERE email = '$user_email' AND status = 'Running'";
        $counter = $connection->query($runningtask);
        $running = $counter->num_rows;
        return $running;
    }
    function completed(){
        global $connection;
        $user_email = checkuseremail();
        $completedtask = "SELECT * FROM `task` WHERE email = '$user_email' AND status = 'Completed'";
        $counter = $connection->query($completedtask);
        $completed = $counter->num_rows;
        return $completed;
    } 
}
 
?>