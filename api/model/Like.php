<?php

class Like implements \JsonSerializable{
    private string $article;
    private string $account;
    
    public function jsonSerialize():mixed{
        return get_object_vars($this);
    }

    public function setArticle(string $article):string{
        $this->article = $article;
        return '';
    }

    public function setAccount(string $account):void{
        $this->account = $account;
    }

    public function getArticle():string{
        return $this->article;
    }

    public function getAccount():string{
        return $this->account;
    }
}