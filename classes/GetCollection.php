<?php

final class GetCollection extends Action
{
  private $collection;

  function __construct($collection) {
    $this->collection = $collection;
  }

  function run($database) {
    $collection = $database->getCollection($this->collection);
    $documents = $collection->getDocuments();
    return new Ok($documents);
  }
}
