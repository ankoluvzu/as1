<?php
if(session_id() == ''){
    session_start();
 }
include_once "database.php";
include_once "helpers.php";
include_once "navigation.php";


if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

if(isset($_POST['submit_category'])){
    if(empty($_POST['name'])){
        echo 'Please select a name for your category!';
        return;
    }

    $name =$_POST['name'];

    $query = "select * from categories where name = :name";

    $stmt= $db->prepare($query);
    $stmt->bindValue(':name',$name);

    $stmt->execute();
    $categoryExists = $stmt->fetch();

    if($categoryExists){
        echo "Category already exists!";
    }
    else{
        $query = "insert into categories(name) values(:name) returning *;";

        $stmt= $db->prepare($query);
        $stmt->bindValue(':name',$name);
    
        $stmt->execute();
        $success = $stmt->fetch();
         /// only happens when db is down
        if(!$success){
            echo "We could not contact the database please contact the system administrator!";
        }
        echo "Category createad, create another one?";
    }
} 
?>

<form action="createCategory.php" method="post">
    <input type="text" name="name" id="name" placeholder="Category Name">
    <br></br>
    <input type="submit" name="submit_category" id="submit_category" value="Create Category">
</form>