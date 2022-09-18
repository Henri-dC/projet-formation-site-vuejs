<?php

class ArticleRepository {
  private PDO $_connexion;

  public function __construct() {
    $this->_connexion = DataBase::getConnexion();
  }

  public function getArticle(string $id): ?Article {
    $stmt = $this->_connexion->prepare('
      SELECT id, title, picture, content, category, author
        FROM Articles
       WHERE id = :id
    ');
    $stmt->execute([
        'id' => $id
    ]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
      return null;
    }
  
    $article = new Article();
    $article->setId($row['id']);
    $article->setTitle($row['title']);
    $article->setPicture($row['picture']);
    $article->setContent($row['content']);
    $article->setCategory($row['category']);
    $article->setAuthor($row['author']);


    return $article;
  }

  public function createArticle(Article $article): Article {
   
    $stmt = $this->_connexion->prepare('
        INSERT INTO Articles (id, title, picture, content, category, author, author_id) 
        VALUES (UUID(), :title, :picture, :content, :category, :author, :author_id);
    ');
    $stmt->execute([
        'title' => $article->getTitle(),
        'picture' => $article->getpicture(),
        'content' => $article->getcontent(),
        'category' => $article->getCategory(),
        'author' => $article->getAuthor(),
        'author_id' => $article->getAuthor_Id()
    ]);
    $stmt = $this->_connexion->prepare('
        SELECT id
          FROM Articles
         WHERE picture = :picture AND content = :content AND title = :title;
    ');
    $stmt->execute([
        'picture' => $article->getpicture(),
        'content' => $article->getcontent(),
        'title' => $article->gettitle(),
    ]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $article->setId($row['id']);

    return $article;
  }

  public function updateArticle(article $article): article {
    $stmt = $this->_connexion->prepare('
        UPDATE Articles
           SET title = :title,
               picture = :picture,
               content = :content
         WHERE id = :id
    ');

    $stmt->execute([
      'picture' => $article->getpicture(),
      'content' => $article->getcontent(),
      'title' => $article->gettitle(),
      'id' => $article->getId()
    ]);

    return $article;
  }

  public function deleteArticle(string $id): void {
    $stmt = $this->_connexion->prepare('
        DELETE FROM Articles
         WHERE id = :id
    ');
    $stmt->execute([
        'id' => $id
    ]);
  }

  public function listArticles(): array {
    $stmt = $this->_connexion->prepare('
      SELECT id, title, picture, content, author_id,category
        FROM Articles;
    ');
    $stmt->execute();

    $articles = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $article = new Article();
      $article->setId($row['id']);
      $article->setTitle(html_entity_decode($row['title']));
      $article->setPicture(html_entity_decode($row['picture']));
      $article->setCategory(html_entity_decode($row['category']));
      $article->setContent(html_entity_decode($row['content']));
      $article->setAuthor_Id(html_entity_decode($row['author_id']));

      array_push($articles, $article);
    }

    return $articles;
  }

  public function listArticlesById(string $id): array {
    $stmt = $this->_connexion->prepare('
      SELECT id, title, picture, content, author_id
        FROM Articles
          WHERE author_id =:id
    ');
    $stmt->execute([
      'id' => $id
  ]);

    $articles = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $article = new Article();
      $article->setId($row['id']);
      $article->setTitle(html_entity_decode($row['title']));
      $article->setPicture(html_entity_decode($row['picture']));
      $article->setContent(html_entity_decode($row['content']));
      $article->setAuthor_Id(html_entity_decode($row['author_id']));

      array_push($articles, $article);
    }

    return $articles;
  }

  public function listArticlesByCategory(string $category): array {
    $stmt = $this->_connexion->prepare('
      SELECT id, title, picture, content, author_id, category
        FROM Articles
          WHERE category =:category
    ');
    $stmt->execute([
      'category' => $category
  ]);

    $articles = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $article = new Article();
      $article->setId($row['id']);
      $article->setTitle(html_entity_decode($row['title']));
      $article->setPicture(html_entity_decode($row['picture']));
      $article->setContent(html_entity_decode($row['content']));
      $article->setAuthor_Id(html_entity_decode($row['author_id']));

      array_push($articles, $article);
    }

    return $articles;
  }
}
