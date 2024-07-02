<?php

session_start();
require_once 'config\Database.php';
require __DIR__ . '/vendor/autoload.php';

use Model\Admin;

$database = new Database();
$db = $database->getConnection();

$admin = new Admin($db);
if (isset($error_message)) {
    unset($error_message);
};
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($admin->login($username, $password)) {
        $_SESSION['admin_username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error_message = "Invalid username or password";
    }
}
?>

<!-- HTML login form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<?php if (isset($error_message)) : ?>
    <p><?= $error_message; ?></p>
<?php endif; ?>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>
</body>
</html>
