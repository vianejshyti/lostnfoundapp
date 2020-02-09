<?php
include('functions.php');
$obj = new functions();
$id = $_POST['itemid'];
$arr['itemname'] = $obj->clean($_POST['itemname']);
$arr['lostorfound'] =$obj->$_POST['lostorfound'];
$arr['description'] = $obj->clean($_POST['description']);
$arr['username'] = $obj->clean($_POST['username']);
$obj->update('items',$id,$arr);
$obj->redirect('success.php');
?>