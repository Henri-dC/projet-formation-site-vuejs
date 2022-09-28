<?php

class AccountRepository {
  private PDO $_connexion;

  public function __construct() {
    $this->_connexion = DataBase::getConnexion();
  }

  public function getAccount(string $id): ?Account {
    $stmt = $this->_connexion->prepare('
      SELECT id, email, password, firstName, lastName, is_admin
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
    $account->setEmail($row['email']);
    $account->setFirstName($row['firstName']);
    $account->setLastName($row['lastName']);
    $account->setEncryptedPassword($row['password']);
    $account->setIsAdmin($row['is_admin']);

    return $account;
  }

  public function createAccount(Account $account): Account {
    $stmt = $this->_connexion->prepare('
        INSERT INTO Account (id, firstName, lastName, email, password) 
             VALUES (UUID(), :firstName, :lastName, :email, :password);
    ');
    $stmt->execute([
        'firstName' => $account->getFirstName(),
        'lastName' => $account->getLastName(),
        'email' => $account->getEmail(),
        'password' => $account->getPassword()
    ]);
    $stmt = $this->_connexion->prepare('
        SELECT id
          FROM Account
         WHERE firstName = :firstName AND lastName = :lastName AND email = :email;
    ');
    $stmt->execute([
        'firstName' => $account->getFirstName(),
        'lastName' => $account->getLastName(),
        'email' => $account->getEmail(),
    ]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $account->setId($row['id']);

    return $account;
  }

  public function updateAccount(Account $account): Account {
    $stmt = $this->_connexion->prepare('
        UPDATE Account
           SET email = :email,
               password = :password,
               firstName = :firstName,
               lastName = :lastName,
               is_admin = :is_admin
         WHERE id = :id
    ');

    $stmt->execute([
      'firstName' => $account->getFirstName(),
      'lastName' => $account->getLastName(),
      'email' => $account->getEmail(),
      'password' => $account->getPassword(),
      'id' => $account->getId(),
      'is_admin' => $account->getIsAdmin()
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
      SELECT id, email, firstName, lastName, is_admin
        FROM Account
    ');
    $stmt->execute();

    $accounts = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $account = new Account();
      $account->setId($row['id']);
      $account->setEmail($row['email']);
      $account->setFirstName(html_entity_decode($row['firstName']));
      $account->setLastName(html_entity_decode($row['lastName']));
      $account->setIsAdmin($row['is_admin']);

      array_push($accounts, $account);
    }
   
    return $accounts;
  }
}
