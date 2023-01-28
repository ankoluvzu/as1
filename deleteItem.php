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


if(isset($_POST['submit_delete_item'])){
    if(empty($_POST['_id_item'])){
        echo 'Please select an item!';
        return;
    }

    $id = $_POST['_id_item'];
    $query = "delete from items where _id_item = :id";

    $stmt= $db->prepare($query);
    $stmt->bindValue(':id',$id);

    $stmt->execute();
    $affectedRows = $stmt->rowCount();
    if($affectedRows === 0){
        echo "We could not delete the Item, please contact the system administrator!";
    }else{
        echo "Item deleted, delete another one?";
    }
} 
    $items = getItems($db);
?>

<form action="deleteItem.php" method="post">
    <label for="_id_item">Item</label>
    <select name ="_id_item">
        <?php foreach($items as $item):?>
            <option value="<?php echo $item['_id_item'];?>"><?php echo $item['name'];?></option>
        <?php endforeach;?>
    </select>
    <br></br>
    <input type="submit" name="submit_delete_item" id="submit_delete_item" value="Delete Item">
</form>