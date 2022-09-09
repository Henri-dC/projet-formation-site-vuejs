<?php

    class LoginApiControler{
        private LoginRepository $_loginRepo;

        public function __construct() {
            $this->_loginRepo = new LoginRepository();
        }

        public function proceedConnexion(Request $request): Response {
            $payload = $request->getData();
            $response = new Response();
           
            //Création d'un crédential avec contrôle des données et hashage mot de passe
            $credentials = new Credentials;
            $errors=[
                'password' => $credentials->setPassword($payload['password']),
                'login' => $credentials->setLogin($payload['login'])
            ];

            // Remove empty errors from the errors array
            $errors = array_filter($errors, function($error, $key) {
            return !empty($error);
            }, ARRAY_FILTER_USE_BOTH);
            
            if (empty($errors)) {
            $connexion = $this->_loginRepo->getConnexion($credentials);
             //Contrôle, un compte existe-t-il avec ce login ?

             if($connexion===NULL){
                $response->setHttpStatusCode(HttpStatusCode::BAD_REQUEST);
                $response->setErrors(['account'=>'Couple login/mot de passe inconnu']);
                return $response;
                }
                
                //contrôle login et password
               
                if($connexion['password']===$credentials->getPassword()){
                setcookie('id', $connexion['id'],0,"/");
    
                 // Remove empty errors from the errors array
                $errors = array_filter($errors, function($error, $key) {
                return !empty($error);
                }, ARRAY_FILTER_USE_BOTH);
                $response->setHttpStatusCode(HttpStatusCode::OK);
                $response->setData($connexion);
                
                }else{
               
                $response->setHttpStatusCode(HttpStatusCode::BAD_REQUEST);
                $response->setErrors(['Couple login/mot de passe inconnu']);
                }
                return $response;
            }else{
                 $response->setHttpStatusCode(HttpStatusCode::BAD_REQUEST);
                $response->setErrors($errors);
                return $response;
            }
           
        }
    }