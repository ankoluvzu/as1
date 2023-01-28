<?php
if(session_id() == ''){
    session_start();
 }
include_once "database.php";
include_once "navigation.php";
include_once  "auctions.php";
if(!isset($_GET['id'])){
echo "Please chose a category from the navbar!";
return;
}
$id = $_GET['id'];