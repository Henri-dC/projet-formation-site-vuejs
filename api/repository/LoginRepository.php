<?php

class LoginRepository {
  private PDO $_connexion;

  public function __construct() {
    $this->_connexion = DataBase::getConnexion();
  }

  public function getConnexion(Credentials $credentials) {
    $stmt = $this->_connexion->prepare('
      SELECT id, login, password, firstName, lastName
        FROM Account
       WHERE login = :login
    ');
    $stmt->execute([
        'login' => $credentials->getLogin()
    ]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return null;
    }

    return $row;
  }
}