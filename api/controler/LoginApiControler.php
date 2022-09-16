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
                'email' => $credentials->setEmail($payload['email'])
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
                $response->setErrors(['account'=>'Couple email/mot de passe inconnu']);
                return $response;
                }
                
                //contrôle email et password
               
                if($connexion['password']===$credentials->getPassword()){
             
                setcookie('id', $connexion['id'],['samesite'=>'None', 'Secure'=>true]);
                setcookie('firstName', $connexion['firstName'],['samesite'=>'None', 'Secure'=>true]);
                setcookie('lastName', $connexion['lastName'],['samesite'=>'None', 'Secure'=>true]);
    
                 // Remove empty errors from the errors array
                $errors = array_filter($errors, function($error, $key) {
                return !empty($error);
                }, ARRAY_FILTER_USE_BOTH);
                $response->setHttpStatusCode(HttpStatusCode::OK);
                $response->setData($connexion);
                
                }else{
               
                $response->setHttpStatusCode(HttpStatusCode::BAD_REQUEST);
                $response->setErrors(['account'=>'Couple email/mot de passe inconnu']);
                }
                return $response;
            }else{
                 $response->setHttpStatusCode(HttpStatusCode::BAD_REQUEST);
                $response->setErrors($errors);
                return $response;
            }
           
        }
    }