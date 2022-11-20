<?php

class LikesRepository {
  private PDO $_connexion;

  public function __construct() {
    $this->_connexion = DataBase::getConnexion();
  }

  public function addLike(string $article, string $user):void{
      $stmt = $this->_connexion->prepare('
      INSERT INTO `Likes` (article_id, account_id)
      VALUES (:article_id, :account_id)
      ');

      $stmt->execute([
        'article_id'=>$article,
        'account_id'=>$user,
      ]);
  }

  public function getLikes():array{
      $stmt = $this->_connexion->prepare('
      SELECT `article_id`, `account_id` FROM `Likes` 
      ');
      $stmt->execute();

      $listLikes =[];
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $like = new Like();
        $like->setArticle($row['article_id']);
        $like->setAccount($row['account_id']);
        array_push($listLikes, $like); 
      }
      return $listLikes;
  }
}