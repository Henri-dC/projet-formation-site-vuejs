<?php

class LoginRepository {
  private PDO $_connexion;

  public function __construct() {
    $this->_connexion = DataBase::getConnexion();
  }

  public function getConnexion(Credentials $credentials) {
    $stmt = $this->_connexion->prepare('
      SELECT id, email, password, firstName, lastName
        FROM Account
       WHERE email = :email
    ');
    $stmt->execute([
        'email' => $credentials->getEmail()
    ]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return null;
    }

    return $row;
  }
}