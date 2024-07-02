<?php
$articles = $articleController->getAllArticles();
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
        <h2><?= htmlspecialchars($article['title']); ?></h2>
        <p><?= htmlspecialchars($article['content']); ?></p>
        <p><small><?= htmlspecialchars($article['created_at']); ?></small></p>
    </div>
<?php endforeach; ?>
</body>
</html>
