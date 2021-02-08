<?php

final class CreateDocument extends Action
{
  private $collection;
  private $document;

  function __construct($collection, $document) {
    $this->collection = $collection;
    $this->document = $document;
  }

  function run($database) {
    try {
      $collection = $database->getCollection($this->collection);
      $id = $collection->createDocument($this->document);
      $collection->save();
      return new Ok($id);
    } catch (InvalidDocument $e) {
      return new BadRequest();
    }
  }
}
