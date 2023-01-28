<?php
if(session_id() == ''){
    session_start();
 }

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

if(isset($_POST['submit_delete_category'])){
    if(empty($_POST['_id_category'])){
        echo 'Please select a category!';
        return;
    }

    $id =$_POST['_id_category'];
    $query = "select * from items where _id_category = :id";

    $stmt= $db->prepare($query);
    $stmt->bindValue(':id',$id);

    $stmt->execute();
    $categoryItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($categoryItems){
        echo "Cannot delete category you have to delete these items first:<br></br>";
        foreach($categoryItems as $item){
            echo $item['name']."<br></br>";
        }
        return;
    }

    $query = "delete * from categories where _id_category = :id returning *";

    $stmt= $db->prepare($query);
    $stmt->bindValue(':id',$id);

    $stmt->execute();
    $success = $stmt->fetch();

    /// should only hapen when db is downs
    if(!$success){
        echo "Something went wrong, please contact the system administrator!";
    }
    echo "Category deleted, delete another one?";   
} 
$categories = getCategories($db);
?>
<form action="deleteCategory.php" method="post">
    <select name ="_id_category">
        <?php foreach($categories as $category):?>
            <option value="<?php echo $category['_id_category'];?>"><?php echo $category['name'];?></option>
        <?php endforeach;?>
    </select>
    <br></br>
    <input type="submit" name="submit_delete_category" id="submit_delete_category" value="Delete Category">
</form>