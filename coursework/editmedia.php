<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunction.php';

try {
    // Check if 'id' is set in the URL
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new Exception('Invalid or missing media ID.');
    }

    if (isset($_POST['mediatext'])) {
        // Update the media record
        updateMedia($pdo, $_POST['mediaid'], $_POST['mediatext'], $_POST['mediaimage']);
        header('location: media.php');
        exit;
    } else {
        // Fetch the media record for editing
        $media = getMedia($pdo, $_GET['id']);
        if (!$media) {
            throw new Exception('Media not found.');
        }

        $title = 'Edit Media';
        ob_start();
        include 'templates/editmedia.html.php';
        $output = ob_get_clean();
    }
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>