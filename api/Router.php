<?php

class Router {
    public function processRequest(Request $request): Response {
        $page = isset($_GET['route']) ? $_GET['route'] : '';
      
        switch($page) {
            case '/account':
                $controler = new AccountApiControler();
                switch($request->getMethod()) {
                    case 'GET':
                        return $controler->proceedListAccounts($request);
                    case 'POST':
                        return $controler->proceedCreateAccount($request);
                    case 'PUT':
                        return $controler->proceedUpdateAccount($request);
                    case 'DELETE':
                        return $controler->proceedDeleteAccount($request);
                }
               
            case '/article':
                $controler = new ArticleApiControler();
                switch($request->getMethod()) {
                    case 'GET':
                        return $controler->proceedListArticles($request);
                    case 'POST':
                        return $controler->proceedCreateArticle($request);
                    case 'PUT':
                        return $controler->proceedUpdateArticle($request);
                    case 'DELETE':
                        return $controler->proceedDeleteArticle($request);
                }

            case '/article/list':
                switch($request->getMethod()) {
                    case 'POST':
                        $controler = new ArticleApiControler();
                        return $controler->proceedListArticlesById($request);
                    case 'GET':
                        $controler = new ArticleApiControler();
                        return $controler->proceedListArticlesByCategory($request);    
                    }

            case '/login':
                $controler = new LoginApiControler();
                    return $controler->proceedConnexion($request);

        
            default:
                $response = new Response();
                $response->setHttpStatusCode(HttpStatusCode::NOT_FOUND);
                $response->setErrors([
                    "Route $page not found !"
                ]);
                return $response;
        }
    }

    public function processLoad(): Response {
        $response = new Response; 
        $response->setErrors(['ok du con']);
        return $response;
    }
}

?>
