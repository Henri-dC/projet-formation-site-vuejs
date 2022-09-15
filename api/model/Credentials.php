<?php

class Credentials {
    private string $_email;
    private string $_password;
    
    public function setPassword(string $password): string {
        if (!empty($password)) {
            $this->_password = hash('sha256', $password);
            return '';
        }
        return 'Veuillez renseigner votre mot de passe';
    }
    public function setEmail(string $email): string {
        if (!empty($email)) {
            $this->_email = $email;
            return '';
        }
        return 'Veuillez renseigner votre email';
    }
    public function getEmail(): string {
        return $this->_email;
    }
    public function getPassword(): string {
        return $this->_password;
    }
    
    public function isPasswordValid(string $accountPassword): bool {
        return $this->_password === $accountPassword;
    }
}