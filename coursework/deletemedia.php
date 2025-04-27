<?php
try{
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunction.php';
    deleteMedia($pdo, $_POST['id']);
    //$sql = 'DELETE FROM joke WHERE id=:id';
    //$stmt = $pdo->prepare($sql);
    //$stmt-> bindValue(':id', $_POST['id']);
    //$stmt-> execute();
    header('location: media.php');
}catch(PDOException $e){
    $title = 'An error has occured';
    $output = 'Unable to connect to delete the post: '.$e ->getMessage();
}
include 'templates/layout.html.php';
?>