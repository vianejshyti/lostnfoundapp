<?php
session_start();
require("config.php");
// Include the database configuration file
//include 'config.php';

$statusMsg = '';

// File upload path
$targetDir = "uploads/";
if(isset($_FILES['file']))
{
    $fileName = $_FILES["file"]["name"];
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    
    if(isset($_POST["itemsubmit"]) && !empty($_FILES["file"]["name"])){
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif','pdf','jfif');
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                // Insert image file name into database
                $lostorfound = isset($_POST['lostorfound']) ? 1 : 0 ;
                $itemname = $_POST['itemname'];
                $date = $_POST['date'];
                $description = $_POST['description'];
                $insert = $_link->query("INSERT INTO items (item_name,itemdescription,lostorfound,username,imagename) 
                VALUES('$itemname','$description','$lostorfound','$_SESSION[username]','".$fileName."')");
                if($insert){
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                    header("location:success.php");
                }else{
                    $statusMsg = "File upload failed, please try again.";
                } 
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
        }
    }else{
        $statusMsg = 'Please select a file to upload.';
    } 
}  
// Display status message
echo "<script>window.location(lostnfoundapp.php);alert(.$statusMsg);</script>";

?>