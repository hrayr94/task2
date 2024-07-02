<?php

use Model\Article;

include_once 'config/Database.php';
include_once 'src/Model/Article.php';

$database = new Database();
$db = $database->getConnection();

$article = new Article($db);
$articles = $article->getAllArticles();
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Articles</title>
    </head>
    <body>
    <h1>Articles</h1>
    <?php foreach ($articles as $article): ?>
        <div>
            <h2><?php echo htmlspecialchars($article['title']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
            <hr>
        </div>
    <?php endforeach; ?>
    </body>
    </html>
<?php
