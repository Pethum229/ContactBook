<?php

// Connect to db
include "db_connection.php";

// Get id for delete records
$id = $_GET['id'];

// Delete Records
$query = $db->prepare("DELETE FROM `contacts` WHERE `id`=?");
$query -> execute (array($_GET['id']));

header ("location:all.php?deleted=1");

?>