<?php
if(session_id() == ''){
    session_start();
 }
include_once "database.php";
if(isset($_POST['submit_login'])){
    if(empty($_POST['username']) || empty($_POST['password'])){
        echo 'Username and password are required!';
        return;
    }
        $username= $_POST['username'];
        $password= sha1($_POST['password']);
        $query = "select * from user where username = :username and password = :password";
        $stmt= $db->prepare($query);
        $stmt->bindValue(":username",$username);
        $stmt->bindValue(":password",$password);
        
        $stmt->execute();
        $logedUser = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($logedUser){
            $_SESSION['user']=$logedUser;
            header('Location: index.php');
        }
}?>

<form action="login.php" method="post">
    <input type="text" name="username" id="username" placeholder="Username">
    <input type="text" name="password" id="password" placeholder="Password">
    <input type="submit" name="submit_login" id="submit_login">
</form>