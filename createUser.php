<?php
if(session_id() == ''){
    session_start();
 }
include_once "database.php";
include_once "navigation.php";

if(isset($_POST['submit_create_user'])){
    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['re_password'])){
        echo 'Please select a username and password!';
        return;
    }
    
        $username= $_POST['username'];
        $password= sha1($_POST['password']);
        $rePassword= sha1($_POST['re_password']);
        if($password !== $rePassword){
            echo "The passwords must match!";
            return;
        }

        $query = "select * from user where username = :username";
        $stmt= $db->prepare($query);
        $stmt->bindValue(":username",$username);
      
        
        $stmt->execute();
        $inUseUsername = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($inUseUsername){
            echo "Username is not available, please chose another one!";
            return;
        }

        $query = "insert into user(username,password) values(:username,:password) returning *;";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);

        $stmt->execute();
        $success = $stmt->fetch();

        if($success){
            header("Location: index.php");
        }
        /// should only happen if db is down
        echo "A problem has occured please contact the system administrator!";
}
?>

<form action="createUser.php" method="post">
    <input type="text" name="username" id="username" placeholder="Username">
    <input type="password" name="password" id="password" placeholder="Password">
    <input type="password" name="re_password" id="re_password" placeholder="Repeat Password">
    <input type="submit" name="submit_create_user" id="submit_create_user">
</form>