<?php
if (isset($_POST['submit'])) {
    try {
        include 'includes/DatabaseConnection.php';
        include 'includes/DatabaseFunction.php';

        $imagePath = 'null'; // Default to null if no image is uploaded
        if (isset($_FILES['mediaimage']) && $_FILES['mediaimage']['error'] === UPLOAD_ERR_OK) {
            $targetDir = './upload/';
            if (!is_dir($targetDir)) {
                if (!mkdir($targetDir, 0777, true)) {
                    throw new Exception("Failed to create uploads directory.");
                }
            }

            $targetFile = $targetDir . basename($_FILES['mediaimage']['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Validate image file
            $check = getimagesize($_FILES['mediaimage']['tmp_name']);
            if ($check === false) {
                throw new Exception("File is not an image.");
            }

            // Allow only certain file formats
            if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                throw new Exception("Only JPG, JPEG, PNG & GIF files are allowed.");
            }

            // Move the uploaded file to the uploads directory
            if (!move_uploaded_file($_FILES['mediaimage']['tmp_name'], $targetFile)) {
                throw new Exception("There was an error uploading your file.");
            }

            // Save the image filename
            
        }
        
        $imagePath = basename($_FILES['mediaimage']['name']);
        // echo json_encode([ 'data' => $imagePath ]);
        // Add post to the database
        insertMedia($pdo, $_POST['mediatext'], $_POST['students'], $_POST['subject_id'], $imagePath);

        // Redirect to the posts list
        header('location: ./media.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    include 'includes/DatabaseConnection.php';
    include 'includes/DatabaseFunction.php';

    $students = allStudent($pdo);
    $subjectes = allSubject($pdo);
    ob_start();
    include 'templates/addmedia.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';