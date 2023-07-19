<?php
include('../function.php');
if (isset($_POST['addstaff'])){
    checksign();
    addstaff();
    
}

?>