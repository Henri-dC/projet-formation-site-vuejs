<?php

class Request {
  private string $_method;
  private array $_queryParams;
  private array $_data;

  public function __construct(string $method, array $queryParams = [], array $inputData = []) {
    $this->_method = $method;
    $this->_queryParams = $queryParams;
    $this->_data = $inputData;
  }

  public function getMethod(): string {
    return $this->_method;
  }
  public function getQueryParam(string $key): mixed {
    if (isset($this->_queryParams) && isset($this->_queryParams[$key])) {
      return $this->_queryParams[$key];
    }
    return null;
  }
  public function getData(){
    return $this->_data;
  }
}
