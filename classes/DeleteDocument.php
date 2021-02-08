<?php

final class DeleteDocument extends Action
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
      $collection->deleteDocument($this->id);
      $collection->save();
      return new NoContent();
    } catch (DocumentNotFound $e) {
      return new NotFound();
    }
  }
}
