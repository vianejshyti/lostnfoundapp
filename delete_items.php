<?php
include('functions.php');
$obj = new functions();
$id = $_GET['itemid'];
if($obj->delete('items',$id))
{
$obj->redirect('success.php');
}
?>