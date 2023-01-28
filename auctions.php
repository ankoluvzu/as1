<?php
include_once "database.php";
include_once "navigation.php";
if(session_id() == ''){
    session_start();
 }

function getAuctions($db,$id=null){
    $query="select i.description,
     i.name as item_name,
     cat.name as category_name,
     top_bid from auctions auc
	join items i on i._id_item = auc._id_item
    join categories cat on cat._id_category = i._id_category
    where end_date > current_date ";

    if($id){
        $query .= "and cat._id_category = :id ";
    }
    
	$query .="order by end_date 
        limit 10";
    $stmt =$db->prepare($query);
    if($id){
        $stmt->bindValue(':id',$id);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?> 
<ul class="productList">
<?php 
if(isset($_GET['id'])){
    $auctions= getAuctions($db,$_GET['id']);
}else{
    $auctions = getAuctions($db);
}
foreach ($auctions as $auction):
           $itemName = $auction['item_name'];
           $categoryName = $auction['category_name'];
           $description = $auction['description'];
           $topBid = $auction['top_bid'];?>
           <li>
          <img src="product.png" alt="product name">
          <article>
              <h2>Product name: <?php echo $itemName?></h2>
              <h3>Product category: <?php echo $categoryName?></h3>
              <p><?php echo $description?></p>
              <p class="price">Current bid: £<?php echo $topBid?></p>
              <a href="#" class="more auctionLink">More &gt;&gt;</a>
          </article>
      </li>
<?php endforeach;?>
</ul>