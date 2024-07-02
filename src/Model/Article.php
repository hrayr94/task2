<?php

namespace Model;

use PDO;

class Article
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllArticles()
    {
        $stmt = $this->pdo->query("SELECT * FROM articles ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createArticle($title, $content)
    {
        $stmt = $this->pdo->prepare("INSERT INTO articles (title, content, created_at) VALUES (:title, :content, NOW())");
        return $stmt->execute([
            ':title' => $title,
            ':content' => $content,
        ]);
    }

}

