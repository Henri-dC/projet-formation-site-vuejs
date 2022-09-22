<?php

class Article implements \JsonSerializable {
    private string $id;
    private string $title;
    private string $picture;
    private string $content;
    private string $category_id;
    private string $author;
    private string $author_Id;

    public function __construct() {
    }

    public function jsonSerialize():mixed{
        return get_object_vars($this);
    }

    public function setId($id): string {
        if (isset($this->id)) {
          return 'Un id est déjà spécifié';
        }
        $this->id = $id;
        return '';
    }

    public function setTitle(string $title): string {
        if (!empty($title)) {
            $this->title = $title;
           
            return '';
        }
        return 'Veuillez renseigner un titre';
    }

    public function setPicture(string $picture): string {
        if (!empty($picture)) {
            $this->picture = $picture;
            return '';
        }
        return 'Veuillez renseigner votre photo';
    }
    
    public function setContent(string $content): string {
        if (!empty($content)) {
            $this->content = $content;
            return '';
        }
        return 'Veuillez écrire du contenu';
    }
    
    public function setCategory_Id(string $category_id): string {
        if (!empty($category)) {
            $this->category_id = $category_id;
            return '';
        }
        return 'Veuillez renseigner une categorie';
    }

    public function setAuthor(string $author): string {
        if (!empty($author)) {
            $this->author = $author;
            return '';
        }
        return 'Veuillez renseigner un auteur';
    }
    public function setAuthor_Id(string $author_Id): string {
        if (!empty($author_Id)) {
            $this->author_Id = $author_Id;
            return '';
        }
        return 'Veuillez renseigner un identifiant auteur';
    }
    
    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getPicture(): string {
        return $this->picture;
    }
    
    public function getContent(): string {
        return $this->content;
    }
    
    public function getCategory_Id(): string {
        return $this->category;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function getAuthor_Id(): string {
        return $this->author_Id;
    }
}
