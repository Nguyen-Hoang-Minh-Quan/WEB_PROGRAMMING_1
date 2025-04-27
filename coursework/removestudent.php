<?php
try {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunction.php';

    // Ensure the 'id' is passed and valid
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        // Check if the student is referenced in other tables (e.g., media)
        $query = 'SELECT COUNT(*) FROM media WHERE studentid = :id';
        $parameters = [':id' => $_POST['id']];
        $result = query($pdo, $query, $parameters)->fetchColumn();

        if ($result > 0) {
            // If the student is referenced, throw an exception
            throw new Exception('Cannot delete student because they are referenced in other records.');
        }

        // Delete the student
        deleteStudent($pdo, $_POST['id']);
        header('location: addstudent.php'); // Redirect back to the student management page
        exit;
    } else {
        throw new Exception('Invalid student ID.');
    }
} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = 'Error: ' . $e->getMessage();
}
include 'templates/layout.html.php';