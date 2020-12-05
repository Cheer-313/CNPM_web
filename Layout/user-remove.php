<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/CNPM/db.php';
//Remove Class
$id = $_GET['id'];
$result = delete_staff($id);
if(!$result){
    return false;
}
unset($_POST);
header("Location: user-list.php");
exit();
?>