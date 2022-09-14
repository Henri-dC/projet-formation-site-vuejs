<?php

class Article implements \JsonSerializable {
    private string $id;
    private string $title;
    private string $picture;
    private string $content;
    private string $category;
    private string $author;

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
    
    public function setCategory(string $category): string {
        if (!empty($category)) {
            $this->category = $category;
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
    
    public function getCategory(): string {
        return $this->category;
    }

    public function getAuthor(): string {
        return $this->author;
    }
}
