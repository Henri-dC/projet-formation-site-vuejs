<?php

class AccountApiControler {
  private AccountRepository $_accountRepo;

  public function __construct() {
    $this->_accountRepo = new AccountRepository();
  }

  public function proceedListAccounts(Request $request): Response {
    if($_SESSION['isAdmin']==='true'){
    $accounts = $this->_accountRepo->listAccounts();
    $response = new Response();
    $response->setHttpStatusCode(HttpStatusCode::OK);
    $response->setData($accounts);

    return $response;
    }else{
    $response = new Response();
    $response->setHttpStatusCode(HttpStatusCode::BAD_REQUEST);
    
    return $response;
    }
  }

  public function proceedCreateAccount(Request $request): Response {
    $payload = $request->getData();

    // Création de l'entité Account et validation des données fournies par le client
    $account = new Account();
    $errors = [
      'email'     => $account->setEmail(htmlentities($payload['email'] ?? '')),
      'password'  => $account->setPassword($payload['password'] ?? ''),
      'firstName' => $account->setFirstName(htmlentities($payload['firstName'] ?? '')),
      'lastName'  => $account->setLastName(htmlentities($payload['lastName'] ?? '')),
    ];

    // Remove empty errors from the errors array
    $errors = array_filter($errors, function($error, $key) {
        return !empty($error);
    }, ARRAY_FILTER_USE_BOTH);

    $response = new Response();
    if (empty($errors)) {
      // Si pas d'erreurs dans les données fournies par le client
      // On créé l'Account dans la BDD
      $account = $this->_accountRepo->createAccount($account);
      $response->setHttpStatusCode(HttpStatusCode::CREATED);
      $response->setData($account);

    } else {
      // S'il y a des erreurs dans les données fournies par le client
      // On les retourne une réponse de type BAD_REQUEST sans créer l'Account dans la BDD
      $response->setHttpStatusCode(HttpStatusCode::BAD_REQUEST);
      $response->setErrors($errors);
    }

    return $response;
  }

  public function proceedUpdateAccount(Request $request): Response {
   
    $accountId = $request->getData()['_id'];
    $account = $this->_accountRepo->getAccount($accountId);
    $payload = $request->getData();

    if (empty($account)) {
      $response = new Response();
      $response->setHttpStatusCode(HttpStatusCode::NOT_FOUND);
      $response->setErrors(['Account not found']);
      return $response;
    }

    $errors = [
      'email'     => $account->setEmail(htmlentities($payload['_email'] ?? '')),
      'firstName' => $account->setFirstName(htmlentities($payload['_firstName'] ?? '')),
      'lastName'  => $account->setLastName(htmlentities($payload['_lastName'] ?? '')),
      'isAdmin'   => $account->setIsAdmin(htmlentities($payload['_isAdmin']??''))
    ];
    if (!empty($payload['password'])) {
      $errors = array_merge($errors, [
        'password'  => $account->setPassword($payload['password']),
      ]);
    }

    // Remove empty errors from the errors array
    $errors = array_filter($errors, function($error, $key) {
        return !empty($error);
    }, ARRAY_FILTER_USE_BOTH);

    $response = new Response();
    if (empty($errors)) {
      $account = $this->_accountRepo->updateAccount($account);
      $response->setHttpStatusCode(HttpStatusCode::OK);
      $response->setData($account);

    } else {
      $response->setHttpStatusCode(HttpStatusCode::BAD_REQUEST);
      $response->setErrors($errors);
    }

    return $response;
  }

  public function proceedDeleteAccount(Request $request): Response {
    $accountId = $request->getQueryParam('id');

    $this->_accountRepo->deleteAccount($accountId);

    $response = new Response();
    $response->setHttpStatusCode(HttpStatusCode::NO_CONTENT);

    return $response;
  }

  public function proceedDestroySession(): Response{
    session_destroy();
    $response = new Response();
    $response->setHttpStatusCode(HttpStatusCode::NO_CONTENT);

    return $response;
  }
}

?>
