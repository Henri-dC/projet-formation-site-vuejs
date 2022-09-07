<?php

class Account implements \JsonSerializable {
    private string $id;
    private string $login;
    private string $password;
    private string $firstName;
    private string $lastName;

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

    public function setPassword(string $password): string {
        if (strlen($password) >= 12 && strlen($password) <= 20) {
            $this->password = hash('sha256', $password);
            return '';
        }
        return 'Votre mot de passe doit avoir entre 12 et 20 caractères';
    }
    
    public function setEncryptedPassword(string $password): void {
        $this->password = $password;
    }

    public function setLogin(string $login): string {
        if (!empty($login)) {
            $this->login = $login;
            return '';
        }
        return 'Veuillez renseigner votre login';
    }
    
    public function setFirstName(string $firstName): string {
        if (!empty($firstName)) {
            $this->firstName = $firstName;
            return '';
        }
        return 'Veuillez renseigner votre prénom';
    }
    
    public function setLastName(string $lastName): string {
        if (!empty($lastName)) {
            $this->lastName = $lastName;
            return '';
        }
        return 'Veuillez renseigner votre nom de famille';
    }
    
    public function getId(): string {
        return $this->id;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function getPassword(): string {
        return $this->password;
    }
    
    public function getFirstName(): string {
        return $this->firstName;
    }
    
    public function getLastName(): string {
        return $this->lastName;
    }
}
