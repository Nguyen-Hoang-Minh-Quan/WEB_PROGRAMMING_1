<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="media.css">
        <title><?=$title?></title>
    </head>
    <body>
        <header>
            <h1>Internet Of Chicken Database</h1></header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="media.php">Post List</a></li>
                <li><a href="addmedia.php">Add a new post</a></li>
                <li><a href="addsubject.php">Management Subjects</a></li>
                <li><a href="addstudent.php">Management Students</a></li>
            </ul>
        </nav>
        <main>
            <?=$output?>
        </main>
        <footer>&copy; chon-jon-cho</footer>
    </body>
</html>