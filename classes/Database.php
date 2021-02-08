<?php

final class Database
{
  function getCollection($name) {
    $file = $name . '.json';
    if (is_file($file)) {
      $contents = file_get_contents($file);
      $data = json_decode($contents);
      $documents = [];
      foreach ($data->documents as $key => $value) {
        $documents[$key] = $value;
      }
      return new Collection($name, $data->count, $documents);
    } else {
      return new Collection($name);
    }
  }
}
