<?php
session_start();
require_once 'config/Database.php';
require __DIR__ . '/vendor/autoload.php';

use Model\Admin;
use Model\Article;

$database = new Database();
$db = $database->getConnection();
$admin = new Admin($db);
$article = new Article($db);

if (!$admin->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if ($article->createArticle($title, $content)) {
        $success_message = "Article created successfully.";
    } else {
        $error_message = "Failed to create article.";
    }
}

$articles = $article->getAllArticles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
<h1>Welcome, Admin!</h1>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="text" name="title" placeholder="Article Title" required><br><br>
    <textarea name="content" placeholder="Article Content" rows="4" cols="50" required></textarea><br><br>
    <button type="submit">Create Article</button>
</form>

<?php
if (isset($error_message)) {
    echo "<p>Error: $error_message</p>";
}
if (isset($success_message)) {
    echo "<p>$success_message</p>";
}
?>

<h2>Existing Articles</h2>
<?php foreach ($articles as $article): ?>
    <div>
        <h3><?php echo htmlspecialchars($article['title']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
        <hr>
    </div>
<?php endforeach; ?>
</body>
</html>
