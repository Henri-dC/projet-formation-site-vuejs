<?php

class ArticleApiControler {
  private ArticleRepository $_articleRepo;

  public function __construct() {
    $this->_articleRepo = new ArticleRepository();
  }

  public function proceedListArticles(Request $request): Response {
    $articles = $this->_articleRepo->listArticles();

    $response = new Response();
    $response->setHttpStatusCode(HttpStatusCode::OK);
    $response->setData($articles);

    return $response;
  }

  public function proceedCreateArticle(Request $request): Response {
    $payload = $request->getData();

    // Création de l'entité Article et validation des données fournies par le client
    $article = new Article();
    $errors = [
      'title'     => $article->setTitle(htmlentities($payload['_title'] ?? '')),
      'picture'  => $article->setPicture($payload['_picture'] ?? ''),
      'content' => $article->setContent(htmlentities($payload['_content'] ?? '')),
      'category'  => $article->setCategory(htmlentities($payload['_category'] ?? '')),
      'author'  => $article->setAuthor(htmlentities($payload['_author'] ?? '')),
    ];

    // Remove empty errors from the errors array
    $errors = array_filter($errors, function($error, $key) {
        return !empty($error);
    }, ARRAY_FILTER_USE_BOTH);

    $response = new Response();
    if (empty($errors)) {
      // Si pas d'erreurs dans les données fournies par le client
      // On créé l'Article dans la BDD
      $article = $this->_articleRepo->createArticle($article);
      $response->setHttpStatusCode(HttpStatusCode::CREATED);
      $response->setData($article);

    } else {
      // S'il y a des erreurs dans les données fournies par le client
      // On les retourne une réponse de type BAD_REQUEST sans créer l'Article dans la BDD
      $response->setHttpStatusCode(HttpStatusCode::BAD_REQUEST);
      $response->setErrors($errors);
    }

    return $response;
  }

  public function proceedUpdateArticle(Request $request): Response {
    $articleId = $request->getQueryParam('id');
    $article = $this->_articleRepo->getArticle($articleId);
    $payload = $request->getData();

    if (empty($article)) {
      $response = new Response();
      $response->setHttpStatusCode(HttpStatusCode::NOT_FOUND);
      $response->setErrors(['Article not found']);
      return $response;
    }

    $errors = [
      'title'     => $article->setTitle(htmlentities($payload['title'] ?? '')),
      'picture' => $article->setPicture(htmlentities($payload['picture'] ?? '')),
      'content'  => $article->setContent(htmlentities($payload['content'] ?? '')),
    ];
   

    // Remove empty errors from the errors array
    $errors = array_filter($errors, function($error, $key) {
        return !empty($error);
    }, ARRAY_FILTER_USE_BOTH);

    $response = new Response();
    if (empty($errors)) {
      $article = $this->_articleRepo->updateArticle($article);
      $response->setHttpStatusCode(HttpStatusCode::OK);
      $response->setData($article);

    } else {
      $response->setHttpStatusCode(HttpStatusCode::BAD_REQUEST);
      $response->setErrors($errors);
    }

    return $response;
  }

  public function proceedDeleteArticle(Request $request): Response {
    $articleId = $request->getQueryParam('id');

    $this->_articleRepo->deleteArticle($articleId);

    $response = new Response();
    $response->setHttpStatusCode(HttpStatusCode::NO_CONTENT);

    return $response;
  }
}

?>