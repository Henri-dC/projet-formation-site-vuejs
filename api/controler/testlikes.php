<?php 
include '../model/Like.php';
[
    'host'     => 'db.3wa.io',
    'dbname'   => 'henridecargouet_projet',
    'user'     => 'henridecargouet',
    'password' => 'ca9e88646dd136996bfac1501ca085db',
];
$dsn = 'mysql:dbname=' . 'henridecargouet_projet' . ';host=' . 'db.3wa.io' . ';charset=utf8';
$db_connexion = new PDO($dsn, 'henridecargouet', 'ca9e88646dd136996bfac1501ca085db');

$stmt = $db_connexion->prepare('
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

var_dump($likeByArticle);


    


