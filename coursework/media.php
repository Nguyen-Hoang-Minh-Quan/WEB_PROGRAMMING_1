<?php
 #require "login/check.php";
 try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunction.php';
    
    /*$sql= 'SELECT * FROM joke
    INNER JOIN author ON authorid = author.id
    INNER JOIN category ON categoryid = category.id';*/
   
    $medias = allMedia($pdo);
    $title = 'Media of Chicken';
    $totalMedias = totalMedias($pdo);
   
    ob_start();
    include 'templates/media.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
?>