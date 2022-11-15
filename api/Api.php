<?php

class Api {
    private Router $_router;

    public function __construct() {
        $this->_router = new Router();
    }

    function init(): void {
       
        $result = $this->decodeJsonFromInput();
        if (empty($result['error'])) {
            $request = new Request($_SERVER['REQUEST_METHOD'], $_GET, $result['jsonData'] ?? []);
            $response = $this->_router->processRequest($request);
        } else {
            $response = new Response();
            $response->setHttpStatusCode(HttpStatusCode::BAD_REQUEST);
            $response->setErrors([$result['error']]);
        }
        $response->sendJsonResponse();
    }

    private function decodeJsonFromInput(): array {
        $result = array();
        $rawData = file_get_contents('php://input');
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT') {
            if (empty($rawData)) {
                $result['error'] = 'No data provided';
            } else {
                $result['jsonData'] = json_decode($rawData, true);
               
                // Check if there is errors on JSON encode
                $jsonError = json_last_error();
                // Crash if an errors occurs
                if ($jsonError !== JSON_ERROR_NONE) {
                    $result['error'] = 'Fail to decode JSON : ' . json_last_error_msg();
                }
            }
        }
        
        return $result;
    }
}
