<?php
if(session_id() == ''){
    session_start();
 }
include_once "helpers.php";
$categories = getCategories($db);
?>
<nav class="navbar">
    <ul class="flex-container">
            <div class="flex-item">
                <li class="list-item"><a class="categoryLink"  href="auth.php">Login</a> </li>
                <li class="list-item"><a class="categoryLink"  href="createItem.php">Create Item</a></li>
                <li class="list-item"><a class="categoryLink"  href="deleteItem.php">Delete Item</a></li>
                <li class="list-item"><a class="categoryLink"  href="createCategory.php">Create Category</a> </li>
                <li class="list-item"><a class="categoryLink"  href="deleteCategory.php">Delete Category</a></li>
                <li class="list-item"><a class="categoryLink"  href="createAuction.php">Create Auctions</a></li>
                <li class="list-item"><a class="categoryLink"  href="deleteAuction.php">Delete Auctions</a></li>
            </div>
        <div class="flex-item">
        Categories:
<?php foreach($categories as $category): ?>
    <li class="list-item">
        <a class="categoryLink"  href="auctions.php?id=<?php echo $category['_id_category']?>"><?php  echo  $category['name']?></a>
    </li>
    <?php endforeach ?>
    </ul>
</nav>
<link rel="stylesheet" href="ibuy.css" />