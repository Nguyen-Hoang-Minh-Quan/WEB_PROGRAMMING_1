<p><?= $totalMedias ?> posts have been submitted to the Internet Media For Chicken Database.</p>
<?php foreach ($medias as $media): ?>
    <div class="media-item" style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <blockquote>
            <?= htmlspecialchars($media['mediatext'], ENT_QUOTES, 'UTF-8') ?>
            <br><?= htmlspecialchars($media['subject'], ENT_QUOTES, 'UTF-8') ?></br>
            <?php $display_date = date("D d M Y", strtotime($media['mediadate'])) ?>
            <?= htmlspecialchars($display_date, ENT_QUOTES, 'UTF-8') ?>
            <img height="150px" src="upload/<?= htmlspecialchars($media['mediaimage'], ENT_QUOTES, 'UTF-8') ?>">
            (by <a href="mailto:<?= htmlspecialchars($media['email'], ENT_QUOTES, 'UTF-8'); ?>">
            <?= htmlspecialchars($media['student_name'], ENT_QUOTES, 'UTF-8'); ?></a>)
        </blockquote>
        <form action="deletemedia.php" method="post" style="text-align: right;">
            <input type="hidden" name="id" value="<?= $media['id']; ?>">
            <button type="submit">Delete</button>
        </form>
        <form action="editmedia.php" method="get" style="text-align: right;">
            <input type="hidden" name="id" value="<?= $media['id']; ?>">
            <button href="editmedia.php?id=<?= $media['id']; ?>">Edit</button>
        </form>


        <!-- Comment Section -->
        <div class="comments" style="margin-top: 15px; padding: 10px; border-top: 1px solid #ccc;">
            <h4>Comments:</h4>
            <?php if (!empty($media['comments']) && is_array($media['comments'])): ?>
                <?php foreach ($media['comments'] as $comment): ?>
                    <p><?= htmlspecialchars($comment['comment_text'], ENT_QUOTES, 'UTF-8'); ?> <small>(<?= $comment['created_at']; ?>)</small></p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No comments yet.</p>
            <?php endif; ?>

            <!-- Add Comment Form -->
            <form action="addcomment.php" method="post" style="margin-top: 10px;">
                <input type="hidden" name="post_id" value="<?= $media['id']; ?>">
                <textarea name="comment_text" rows="2" cols="50" placeholder="Add a comment..." required style="width: 100%; padding: 5px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
                <button type="submit" style="margin-top: 5px; padding: 5px 10px; border: none; background-color: #007BFF; color: white; border-radius: 4px;">Post Comment</button>
            </form>
        </div>
    </div>
<?php endforeach; ?>