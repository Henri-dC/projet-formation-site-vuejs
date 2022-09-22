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
      'category'  => $article->setCategory_Id(htmlentities($payload['_category'] ?? '')),
      'author'  => $article->setAuthor(htmlentities($payload['_author'] ?? '')),
      'author_Id'  => $article->setAuthor_Id(htmlentities($payload['_author_Id'] ?? '')),
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

    $payload = $request->getData();
    $article = new Article();
    

    $errors = [
      'id'=>$article->setId($payload['_id']),
      'title' => $article->setTitle(htmlentities($payload['_title'] ?? '')),
      'picture' => $article->setPicture(htmlentities($payload['_picture'] ?? '')),
      'content' => $article->setContent(htmlentities($payload['_content'] ?? '')),
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
    var_dump($articleId);
    $this->_articleRepo->deleteArticle($articleId);

    $response = new Response();
    $response->setHttpStatusCode(HttpStatusCode::NO_CONTENT);

    return $response;
  }

  public function proceedListArticlesByAuthor(Request $request): Response {
    $articleId = $request->getData();
   
   $article = $this->_articleRepo->listArticlesByAuthor($articleId['id']);

    $response = new Response();
    $response->setHttpStatusCode(HttpStatusCode::OK);
    $response->setData($article);
    return $response;
  }

  public function proceedListArticlesByCategory(Request $request): Response {
    $category = $request->getQueryParam('category');
   
    $article = $this->_articleRepo->listArticlesByCategory($category);

    $response = new Response();
    $response->setHttpStatusCode(HttpStatusCode::OK);
    $response->setData($article);
    return $response;
  }
}

?>