<?php

spl_autoload_register(function ($name) {
  require __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $name . '.php';
});

$server = new Server();
$server->respond()->send();
