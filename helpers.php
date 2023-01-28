<?php
include_once "database.php";

function getCategories($db){
    $query = "select * from categories";

    $stmt = $db->prepare($query);
    
     $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getItems($db){
    $query = "select * from items";

    $stmt = $db->prepare($query);
    
     $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function prePrint($message,$die =false){
    echo "<pre>";print_r($message);echo "</pre>";
    if($die)die;
}
