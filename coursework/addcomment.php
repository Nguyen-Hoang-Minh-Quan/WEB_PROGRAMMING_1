<?php
try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunction.php';

    if (isset($_POST['post_id'], $_POST['comment_text']) && !empty($_POST['comment_text'])) {
        $post_id = $_POST['post_id'];
        $comment_text = $_POST['comment_text'];

        $query = 'INSERT INTO comments (post_id, comment_text) VALUES (:post_id, :comment_text)';
        $parameters = [
            ':post_id' => $post_id,
            ':comment_text' => $comment_text
        ];
        query($pdo, $query, $parameters);

        header('Location: media.php'); // Redirect back to the post list
        exit;
    } else {
        throw new Exception('Invalid comment data.');
    }
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}
include 'templates/layout.html.php';