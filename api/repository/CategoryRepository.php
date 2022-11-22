<?php

/*In this repository : -createCategory
                       -getCategories               
*/

    class CategoryRepository{
        private PDO $_connexion;

        public function __construct() {
        $this->_connexion = DataBase::getConnexion();
        }

        public function createCategory(Category $category):void{
            $stmt = $this->_connexion->prepare('
            INSERT INTO `Categories` (id, name) VALUES (UUID(), :name)');
            $stmt->execute([
            'name' => $category->getName()
            ]);
        }

        public function getCategories():array{
            $stmt = $this->_connexion->prepare('
            SELECT * FROM `Categories`
            ');
            $stmt->execute();

            $categories = [];

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $category = new Category();
            $category->setId($row['id']);
            $category->setName($row['name']);

            array_push($categories, $category);
            }
            
            return $categories;
        }
    }