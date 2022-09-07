<?php

class Response {
  private int $_httpStatusCode;
  private $_data;
  private array $_errors;

  public function setHttpStatusCode(int $httpStatusCode): void {
    $this->_httpStatusCode = $httpStatusCode;
  }
  public function setData($data): void {
    $this->_data = $data;
  }
  public function setErrors(array $errors): void {
    $this->_errors = $errors;
  }
  public function sendJsonResponse() {
    header("Content-Type: application/json; charset=UTF-8");
    
    // Encode output data and errors into JSON
    $json = json_encode([
      'data' => isset($this->_data) ? $this->_data : null,
      'errors' => isset($this->_errors) ? $this->_errors : null,
    ]);

    // Check if there is errors on JSON encode
    $jsonError = json_last_error();
    // Crash if an errors occurs
    if ($jsonError !== JSON_ERROR_NONE) {
      http_response_code(HttpStatusCode::INTERNAL_SERVER_ERROR);
      echo json_encode([
        'errors' => [
          'Fail to encode JSON : ' . json_last_error_msg()
        ]
      ]);
    } else {
      http_response_code($this->_httpStatusCode);
      echo $json;
    }
  }
}
