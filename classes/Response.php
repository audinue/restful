<?php

abstract class Response
{
  private $code;
  private $body;

  function __construct($code, $body = '') {
    $this->code = $code;
    $this->body = $body;
  }

  function send() {
    http_response_code($this->code);
    header('Content-Type: application/json');
    echo $this->body;
  }
}
