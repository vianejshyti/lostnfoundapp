<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'projectdb');
//declare a global variable
 
/* Attempt to connect to MySQL database */
$_link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($_link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
/*
$items = "CREATE TABLE items (
    itemid int AUTO_INCREMENT NOT NULL PRIMARY KEY,
    item_name varchar(50) NOT NULL,
    itemdescription varchar(200),
    lostorfound boolean NOT NULL,
    username varchar(50) NOT NULL, 
    imagename varchar(20) NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username)
    )";

$comments = "CREATE TABLE comments (
    comment_user varchar(50) NOT NULL, 
    comment varchar(200),
    FOREIGN KEY (comment_user) REFERENCES users(username)
)";

if($_link->query($comments))
{
    echo"success";
}
*/
?>