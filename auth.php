<?
if(session_id() == ''){
    session_start();
 }
include_once "database.php";
 
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    include_once "logout.php";
}else{
    include_once "login.php";
}