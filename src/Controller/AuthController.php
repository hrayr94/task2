<?php

namespace Controller;

use Model\Admin;

class AuthController
{
    private $adminModel;

    public function __construct($pdo)
    {
        $this->adminModel = new Admin($pdo);
    }

    public function login($username, $password)
    {
        if ($this->adminModel->adminLogin($username, $password)) {
            session_start();
            $_SESSION['logged_in'] = true;
            header('Location: admin/dashboard.php');
            exit;
        } else {
            return false;
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}