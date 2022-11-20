<?php

class LikesApiControler {
  private LikesRepository $_articleRepo;

  public function __construct() {
    $this->_likesRepo = new LikesRepository();
  }

  public function proceedAddLike(Request $request): Response {
    $payload = $request->getData();
    $likes = $this->_likesRepo->addLike($payload['article'], $payload['user']);
    $response = new Response();
    $response->setHttpStatusCode(HttpStatusCode::OK);
   
    return $response;
  }

  public function proceedGetLikes(): Response{
    $listLikes = $this->_likesRepo->getLikes();
    $likeByArticle=[];
    $tab = [];

    foreach ($listLikes as $key=>$like){
      if(!in_array($like->getArticle(), $tab)){
        array_push($tab, $like->getArticle());
      }
    }

    foreach ($tab as $key=>$articleId){
      $count=[];
      foreach ($listLikes as $key=>$like){
        if($articleId===$like->getArticle()){
        array_push($count, $like->getArticle());
        }
      }
      $article=(object)array('article'=>$articleId, 'like'=>count($count));
      array_push($likeByArticle, $article);
    }


    $response = new Response();
    $response->setHttpStatusCode(HttpStatusCode::OK);
    $response->setData($likeByArticle);

    return $response;
  }

};

