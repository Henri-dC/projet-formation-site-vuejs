<?php

/*In this repository : -addLike
                       -getLikes  
                       -getLikesByUser
                       -deleteLikes
                       -deleteOneLike
*/

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

  public function getLikesByUser(string $user):array{
    $stmt = $this->_connexion->prepare('
    SELECT `article_id`
    FROM `Likes`
    WHERE `account_id`= :account_id
    ');
    $stmt->execute(['account_id'=>$user]);

    $likesByUser =[];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      array_push($likesByUser, $row['article_id']);
    }

    return $likesByUser;

  }

  public function deleteLikes(string $article){
    $stmt = $this->_connexion->prepare('
    DELETE FROM `Likes`
    WHERE article_id = :article_id;
      ');
    $stmt->execute(['article_id'=>$article]);
  }

  public function deleteOneLike(string $article, string $user){
    $stmt = $this->_connexion->prepare('
    DELETE FROM `Likes`
    WHERE article_id = :article_id AND account_id = :account_id
      ');
    $stmt->execute(['article_id'=>$article, 'account_id'=>$user]);
  }


}