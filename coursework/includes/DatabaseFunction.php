<?php
function query($pdo, $sql, $parameters =[]){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function totalMedias($pdo){
    $query = $pdo->prepare('SELECT COUNT(*)FROM media');
    $query->execute();
    $row = $query->fetch();
    return $row[0];
}

function getMedia($pdo, $id){
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT * FROM media WHERE id =:id', $parameters);
    return $query->fetch();
}

function updateMedia($pdo, $mediaId, $mediatext, $mediaimage){
    $query = 'UPDATE media SET mediatext = :mediatext, mediaimage= :mediaimage WHERE id = :id';
    $parameters = [':mediatext' => $mediatext, ':id'=> $mediaId, ':mediaimage'=> $mediaimage];
    query($pdo, $query, $parameters);
}

function deleteMedia($pdo, $id){
    $parameters = [':id'=> $id];
    query($pdo, 'DELETE FROM media WHERE id = :id', $parameters);
}

function insertMedia($pdo, $mediatext, $studentid, $subject_id, $mediaimage){
    $query = 'INSERT INTO media (mediatext, mediadate, studentid, subject_id, mediaimage)
    VALUES (:mediatext, CURDATE(), :studentid, :subject_id, :mediaimage)';
    $parameters = [':mediatext'=> $mediatext, ':studentid'=> $studentid, ':subject_id' => $subject_id, ':mediaimage'=> $mediaimage];
    query($pdo, $query, $parameters);
}

function allStudent($pdo) {
    $authors = query($pdo, 'SELECT * FROM student');
    return $authors->fetchAll();
}

function allSubject($pdo) {
    $Subjectes = query($pdo, 'SELECT * FROM `subject`');
    return $Subjectes->fetchAll();
}

function allMedia($pdo) {
    // Fetch all media posts
    $medias = query($pdo, 'SELECT media.id, mediatext, mediadate, mediaimage, student_name, email, studentid, subject_id, `subject` FROM media
    INNER JOIN student ON studentid = student.id
    INNER JOIN `subject` ON subject_id = subject.id')->fetchAll(PDO::FETCH_ASSOC);

    // Fetch comments for each media post
    foreach ($medias as &$media) {
        $query = 'SELECT * FROM comments WHERE post_id = :post_id ORDER BY created_at DESC';
        $parameters = [':post_id' => $media['id']];
        $media['comments'] = query($pdo, $query, $parameters)->fetchAll(PDO::FETCH_ASSOC) ?: []; // Ensure comments is always an array
    }

    return $medias;
}

function addSubject($pdo, $subject){
    $query = 'INSERT INTO `subject` (`subject`) VALUES (:subject)';
    $parameters = [':subject' => $subject];
    query($pdo, $query, $parameters);
}
function deleteSubject($pdo, $id) {

    $query = 'DELETE FROM media WHERE subject_id = :id';
    $parameters = [':id' => $id];
    query($pdo, $query, $parameters);
    $query = 'DELETE FROM `subject` WHERE id = :id';
    query($pdo, $query, $parameters);
}

function addStudent($pdo, $student_name, $email) {
    $query = 'INSERT INTO student (student_name, email) VALUES (:student_name, :email)';
    $parameters = [
        ':student_name' => $student_name,
        ':email' => $email
    ];
    query($pdo, $query, $parameters);
}

function deleteStudent($pdo, $id) {
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM student WHERE id = :id', $parameters);
}
?>
