<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ProjectDB";

// Create connection
$link = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
$FoundTableSql ="CREATE TABLE IF NOT EXISTS `founditem` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `date_found` date DEFAULT NULL,
 `item_name` varchar(45) NOT NULL,
 `found_location` varchar(45) NOT NULL,
 `users_id` int(10) unsigned NOT NULL,
 `date_added` date DEFAULT NULL,
 'image' image DEFAULT NULL,
 PRIMARY KEY (`id`,`users_id`),
 KEY `fk_found_listing_users1_idx` (`users_id`)";

$sqlAddFoundItem = "INSERT INTO `founditem` (`id`, `date_found`, `item_name`, `found_location`, `users_id`,`date_added`,'image')";

$losttablesql = "CREATE TABLE IF NOT EXISTS lostitem (
	id int(10) unsigned NOT NULL AUTO_INCREMENT,
	date_added date DEFAULT NULL,
	date_lost date DEFAULT NULL,
	item_name varchar(45) NOT NULL,
	user_name varchar(45) NOT NULL,
	user_email varchar(80) NOT NULL,
	lost_location varchar(45) NOT NULL,
	description varchar(10000) DEFAULT NULL,
	users_id int(10) unsigned NOT NULL,
	PRIMARY KEY (`id`,`users_id`),
	KEY `fk_lost_listing_users_idx` (`users_id`))";

$sqlAddLostItem = "INSERT INTO `lostitem` (`id`, `date_added`, `date_lost`, `item_name`, `user_name`,
`user_email`, `lost_location`, `description`, `users_id`)";

$usertablesql = "CREATE TABLE IF NOT EXISTS `users` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `username` varchar(15) DEFAULT NULL,
 `password` varchar(20) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `username_UNIQUE` (`username`)
)";

$sqlAddUser = "INSERT INTO `users` (`id`, `username`, `password`)";

$link->query($usertablesql);
$link->query($losttablesql);
$link->query($FoundTableSql);



$link->close();
?>