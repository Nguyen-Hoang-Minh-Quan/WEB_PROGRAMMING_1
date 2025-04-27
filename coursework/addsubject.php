<?php
if (isset($_POST['subject'])) {
    try {
        include 'includes/DatabaseConnection.php';
        include 'includes/DatabaseFunction.php';

        // Call the addSubject function to insert the subject
        addSubject($pdo, $_POST["subject"]);

        // Redirect after successful insertion
        header('location: media.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunction.php';
    $title = 'Managemet subjects';
    $output = 'Please fill in the form to add a new subject.';
    $students = allStudent($pdo);
    $subjects = allSubject($pdo);
    ob_start();
    include 'templates/managesubject.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';