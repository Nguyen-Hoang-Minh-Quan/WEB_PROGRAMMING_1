<form action="" method="post" enctype="multipart/form-data">
    <div style="margin-bottom: 15px;">
        <label for="subject" style="display: block; font-weight: bold; margin-bottom: 5px;">Type your text here:</label>
        <textarea name="subject" id="subject" rows="3" cols="40" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
    </div>
    <div style="text-align: center;">
        <input type="submit" name="submit" value="Add Subject">
    </div>
</form>

<h2>Manage Subjects</h2>
<?php foreach ($subjects as $subject): ?>
    <form action="deletesubject.php" method="post">
        <input type="hidden" name="id" value="<?= $subject['id']; ?>">
        <p>
            <?= $subject['subject']; ?>
            <input type="submit" value="Delete">
        </p>
    </form>
<?php endforeach; ?>
