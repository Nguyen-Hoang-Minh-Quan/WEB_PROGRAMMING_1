<form action="" method="post" enctype="multipart/form-data">
    <label for='mediatext'> Type your text here</label>
    <textarea name="mediatext" row="3" cols="40"></textarea>
    
    <label for='mediaimage'>Add image</label>
    <input type="file" name="mediaimage" id="mediaimage">
   
    <select name="students">
    <option value="">select an students</option>
    <?php foreach ($students as $student):?>
        <option value="<?=htmlspecialchars($student['id'], ENT_QUOTES, 'UTF-8'); ?>">
            <?=htmlspecialchars($student['student_name'], ENT_QUOTES, 'UTF-8'); ?>
        </option>
    <?php endforeach;?>
    </select>


    <select name="subject_id">
        <option value=""> select the subject</option>
        <?php foreach ($subjectes as $subject):?>
            <option value="<?=htmlspecialchars($subject['id'], ENT_QUOTES, 'UTF-8'); ?>">
            <?=htmlspecialchars($subject['subject'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
            <?php endforeach;?>
    </select>

    
    <input type="submit" name="submit" value="Add post">
</form>