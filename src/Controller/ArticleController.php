<?php

namespace Controller;

use Model\Article;
class ArticleController
{
    private $articleModel;

    public function __construct($pdo)
    {
        $this->articleModel = new Article($pdo);
    }

    public function getAllArticles()
    {
        return $this->articleModel->getAllArticles();
    }

    public function createArticle($title, $content)
    {
        return $this->articleModel->createArticle($title, $content);
    }
}