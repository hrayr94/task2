<?php

namespace Model;

class Admin
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function login($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($admin['password']==$password) {
            return true;
        }
        return false;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['admin_username']);
    }
}
