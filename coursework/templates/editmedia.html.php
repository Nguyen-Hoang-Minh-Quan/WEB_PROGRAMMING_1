<form action="" method="post">
    <input type="hidden" name="mediaid" value="<?=$media['id'];?>">
    <label for='mediatext'>Edit your text here;</label>
    <textarea name="mediatext" rows="3" cols="40">
        <?=$media['mediatext']?>
    </textarea>
    <label for='mediaimage'>Edit your image here;</label>
    <textarea name="mediaimage" rows="3" cols="40">
        <?=$media['mediaimage']?>"
    </textarea>
    <input type="submit" name="submit" value="Save">
</form>