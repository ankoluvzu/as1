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

if(isset($_POST['submit_item'])){
    if(empty($_POST['name']) || empty($_POST['description'])){
        echo 'Please select a description and name for your item!';
    }else{
        $name =$_POST['name'];
        $description = $_POST['description'];
        $id = $_POST['_id_category'];
        $query = "insert into items(name,description,_id_category) values(:name,:description,:id) returning *;";
    
        $stmt= $db->prepare($query);
        $stmt->bindValue(':name',$name);
        $stmt->bindValue(':description',$description);
        $stmt->bindValue(':id',$id);
    
        $stmt->execute();
        $success = $stmt->fetch();
        if(!$success){
            echo "We could not contact the database please contact the system administrator!";
            
        }
        echo "Item createad, create another one?";
    }
} 
    $categories = getCategories($db);
?>

<form action="createItem.php" method="post">
    <input type="text" name="name" id="name" placeholder="Item Name">
    <br></br>
    <input type="text" name="description" id="description" placeholder="Item Description">
    <br></br>
    <label for="_id_category">Category</label>
    <select name ="_id_category">
        <?php foreach($categories as $category):?>
            <option value="<?php echo $category['_id_category'];?>"><?php echo $category['name'];?></option>
        <?php endforeach;?>
    </select>
    <br></br>
    <input type="submit" name="submit_item" id="submit_item" value="Create Item">
</form>