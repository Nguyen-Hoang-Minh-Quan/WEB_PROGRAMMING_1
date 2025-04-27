<form action="addstudent.php" method="post" enctype="multipart/form-data">
    <div style="margin-bottom: 15px;">
        <label for="student_name" style="display: block; font-weight: bold; margin-bottom: 5px;">Student Name:</label>
        <input type="text" name="student_name" id="student_name" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>

        <label for="email" style="display: block; font-weight: bold; margin-bottom: 5px; margin-top: 10px;">Email:</label>
        <input type="email" name="email" id="email" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
    </div>
    <div style="text-align: center;">
        <input type="submit" name="submit" value="Add Student" style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer;">
    </div>
</form>

<h2>Existing Students</h2>
<?php foreach ($students as $student): ?>
    <form action="removestudent.php" method="post" style="margin-bottom: 10px;">
        <input type="hidden" name="id" value="<?= $student['id']; ?>">
        <p>
            <?= htmlspecialchars($student['student_name'], ENT_QUOTES, 'UTF-8'); ?> (<?= htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8'); ?>)
            <input type="submit" value="Delete">
        </p>
    </form>
<?php endforeach; ?>