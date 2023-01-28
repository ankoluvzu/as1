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




if(isset($_POST['submit_auction'])){    
    if(empty($_POST['name']) || empty($_POST['description']) || empty($_POST['date'])){
        echo 'Please select a description, a name and an end date for your auction!';
    }else{
        $currentDate = date("d/m/Y");

        $name =$_POST['name'];
        $description = $_POST['description'];
        $id = $_POST['_id_category'];
        $query = "insert into auctions(_id_item,posting_user_id,name,description,end_date) values(:name,:description,:id) returning *;";
    
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

    $items = getItems($db);
?>
<form action="createAuction.php" method="post">
    <input type="text" name="name" id="name" placeholder="Auction Name">
    <br></br>
    <input type="text" name="description" id="description" placeholder="Auction Description">
    <br></br>
    <label for="date">End Date</label>
    <input type="date" name="date" id="date">
    <br></br>
    <label for="_id_item">Item</label>
    <select name ="_id_item">
        <?php foreach($items as $item):?>
            <option value="<?php echo $item['_id_item'];?>"><?php echo $item['name'];?></option>
        <?php endforeach;?>
    </select>
    <br></br>
    <input type="submit" name="submit_auction" id="submit_auction" value="Create Auction">
</form>