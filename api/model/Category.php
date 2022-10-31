<?php

class Category implements \JsonSerializable {
    private string $id;
    private string $name;

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

    public function setName(string $name): string {
        if (!empty($name)) {
            $this->name = $name;
            return '';
        }
        return 'Veuillez renseigner une catégorie';
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

}
