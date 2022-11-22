<?php

/* 
In this controller : -proceedConnexion
*/

    class LoginApiControler{
        private LoginRepository $_loginRepo;

        public function __construct() {
            $this->_loginRepo = new LoginRepository();
        }

        public function proceedConnexion(Request $request): Response {

            $payload = $request->getData();
            $response = new Response();
            $credentials = new Credentials;

            //Credentials and errors

            $errors=[
                'password' => $credentials->setPassword($payload['password']),
                'email' => $credentials->setEmail($payload['email'])
            ];
            $errors = array_filter($errors, function($error, $key) {
            return !empty($error);
            }, ARRAY_FILTER_USE_BOTH);
            
            if (empty($errors)) {
            $connexion = $this->_loginRepo->getConnexion($credentials);

             //Does the account exists (with this login)

             //If no, return error
             if($connexion===NULL){
                $response->setHttpStatusCode(HttpStatusCode::BAD_REQUEST);
                $response->setErrors(['account'=>'Couple email/mot de passe inconnu']);
                return $response;
                }
                
                //If yes, control password
               
                if($connexion['password']===$credentials->getPassword()){
                    
                //if it's ok, let's set somes cookies and $SESSION
                setcookie('id', $connexion['id'],['samesite'=>'None', 'Secure'=>true]);
                setcookie('firstName', $connexion['firstName'],['samesite'=>'None', 'Secure'=>true]);
                $_SESSION['isAdmin']=$connexion['is_admin'];
                $_SESSION['id']=$connexion['id'];

                 // Remove empty errors from the errors array
                $errors = array_filter($errors, function($error, $key) {
                return !empty($error);
                }, ARRAY_FILTER_USE_BOTH);

                $response->setHttpStatusCode(HttpStatusCode::OK);
                $response->setData($connexion);
                
                }else{
                    
                //If login and password doesn't match = error
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