<?php

class AccountRepository {
  private PDO $_connexion;

  public function __construct() {
    $this->_connexion = DataBase::getConnexion();
  }

  public function getAccount(string $id): ?Account {
    $stmt = $this->_connexion->prepare('
      SELECT id, login, password, firstName, lastName
        FROM Account
       WHERE id = :id
    ');
    $stmt->execute([
        'id' => $id
    ]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
      return null;
    }
  
    $account = new Account();
    $account->setId($row['id']);
    $account->setLogin($row['login']);
    $account->setFirstName($row['firstName']);
    $account->setLastName($row['lastName']);
    $account->setEncryptedPassword($row['password']);

    return $account;
  }

  public function createAccount(Account $account): Account {
    $stmt = $this->_connexion->prepare('
        INSERT INTO Account (id, firstName, lastName, login, password) 
             VALUES (UUID(), :firstName, :lastName, :login, :password);
    ');
    $stmt->execute([
        'firstName' => $account->getFirstName(),
        'lastName' => $account->getLastName(),
        'login' => $account->getLogin(),
        'password' => $account->getPassword()
    ]);
    $stmt = $this->_connexion->prepare('
        SELECT id
          FROM Account
         WHERE firstName = :firstName AND lastName = :lastName AND login = :login;
    ');
    $stmt->execute([
        'firstName' => $account->getFirstName(),
        'lastName' => $account->getLastName(),
        'login' => $account->getLogin(),
    ]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $account->setId($row['id']);

    return $account;
  }

  public function updateAccount(Account $account): Account {
    $stmt = $this->_connexion->prepare('
        UPDATE Account
           SET login = :login,
               password = :password,
               firstName = :firstName,
               lastName = :lastName
         WHERE id = :id
    ');

    $stmt->execute([
      'firstName' => $account->getFirstName(),
      'lastName' => $account->getLastName(),
      'login' => $account->getLogin(),
      'password' => $account->getPassword(),
      'id' => $account->getId()
    ]);

    return $account;
  }

  public function deleteAccount(string $id): void {
    $stmt = $this->_connexion->prepare('
        DELETE FROM Account
         WHERE id = :id
    ');
    $stmt->execute([
        'id' => $id
    ]);
  }

  public function listAccounts(): array {
    $stmt = $this->_connexion->prepare('
      SELECT id, login, firstName, lastName
        FROM Account
    ');
    $stmt->execute();

    $accounts = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $account = new Account();
      $account->setId($row['id']);
      $account->setLogin($row['login']);
      $account->setFirstName($row['firstName']);
      $account->setLastName($row['lastName']);

      array_push($accounts, $account);
    }

    return $accounts;
  }
}
