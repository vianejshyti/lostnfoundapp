<?php
include("config.php");
session_start();
$commenttosubmit = $_POST['comment'];
$itemid = $_POST['itemid'];
$result = mysqli_query($_link,"SELECT imagename FROM items WHERE (itemid = '$itemid')");
$row = mysqli_fetch_object($result);
$imagename = $row->imagename;
$sqlinsertcomment = "INSERT INTO comments (comment_user, comment, comment_image) VALUES ('$_SESSION[username]','$commenttosubmit','$imagename')";
    if(mysqli_query($_link,$sqlinsertcomment))
    {
        echo"Komenti u inserua me sukses ";
    }
?>