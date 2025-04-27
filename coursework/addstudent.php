<?php
if (isset($_POST['student_name']) && isset($_POST['email'])) {
    try {
        include 'includes/DatabaseConnection.php';
        include 'includes/DatabaseFunction.php';

        // Add the student to the database
        addStudent($pdo, $_POST['student_name'], $_POST['email']);

        // Redirect back to the student management page
        header('location: addstudent.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunction.php';

    $title = 'Manage Students';
    $students = allStudent($pdo); // Fetch all students
    ob_start();
    include 'templates/managestudent.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';