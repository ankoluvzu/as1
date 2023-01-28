<?php

if(isset($_POST['submit'])){

    $stmt = $pdo->prepare('UPDATE category
                           SET title = :title,
                           description = :description,
                           price = :price,
                           categoryID = :categoryID,
                           closingDate = :closingDate
                           WHERE id = :id
');
    $criteria = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'categoryID' => $_POST['categoryID'],
        'closingDate' => $_POST['closingDate'],
        'id' => $_POST['id'],
    ];

    $stmt->execute($criteria);

    echo 'category saved';
} else {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $stmt = $pdo->prepare('SELECT * FROM category WHERE id = id');
        $stmt->execute($_GET);
        $category = $stmt->fetch();

        ?>

<h3>Edit Category</h3>

<form action="editcategory.php" method="POST">

    <input type="hidden" name="id" value="<?php echo $category['id']; ?> "/>
    <label>Title</label>
    <input type="hidden" name="title" value="<?php echo $category['title']; ?> "/>

    <label>Description</label>
    <input type="hidden" name="description" value="<?php echo $category['description']; ?> "/>

    <label>Price</label>
    <input type="hidden" name="price" value="<?php echo $category['price']; ?> "/>

    <label>Category</label>
    <select name ="categoryID">

    <label>Closing Date</label>
    <input type="hidden" name="closingDate" value="<?php echo $category['closingDate']; ?> "/>

    <?php
            $stmt = $pdo->prepare('SELECT * FROM category');
            $stmt->execute();

            foreach ($stmt as $row) {
                if ($category['categoryID'] == $row['id']) {
                    echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                } else {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            }
            ?>
    </select>

    <label>Closing Date </label>
    <input type="date" name="closingDate" value="<?php echo $job['closingDate']; ?>" />

    <input type="submit" name='submit' value="Save" />
</form>


<?php
    } else {
        ?>
                <h2>Log in</h2>

                <form action="index.php" method="post" >

                <label>Password</label>
                <input type="password" name="password" />

            </form>
        <?php

    }
}