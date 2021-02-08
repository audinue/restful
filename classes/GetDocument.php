<?php

final class GetDocument extends Action
{
  private $collection;
  private $id;

  function __construct($collection, $id) {
    $this->collection = $collection;
    $this->id = $id;
  }

  function run($database) {
    try {
      $collection = $database->getCollection($this->collection);
      $document = $collection->getDocumentById($this->id);
      return new Ok($document);
    } catch (DocumentNotFound $e) {
      return new NotFound();
    }
  }
}
