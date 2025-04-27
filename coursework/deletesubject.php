<?php
try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunction.php';

    // Ensure the 'id' is passed and valid
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        // Check if the subject is referenced in other tables (e.g., media)
        $query = 'SELECT COUNT(*) FROM media WHERE subject_id = :id';
        $parameters = [':id' => $_POST['id']];
        $result = query($pdo, $query, $parameters)->fetchColumn();

        if ($result > 0) {
            // If the subject is referenced, throw an exception
            throw new Exception('Cannot delete subject because it is referenced in other records.');
        }

        // If no references exist, delete the subject
        deleteSubject($pdo, $_POST['id']);
        header('location: addsubject.php'); // Redirect back to the subject management page
        exit;
    } else {
        throw new Exception('Invalid subject ID.');
    }
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}
include 'templates/layout.html.php';