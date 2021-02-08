<?php

final class UpdateDocument extends Action
{
  private $collection;
  private $id;
  private $document;

  function __construct($collection, $id, $document) {
    $this->collection = $collection;
    $this->id = $id;
    $this->document = $document;
  }

  function run($database) {
    try {
      $collection = $database->getCollection($this->collection);
      $collection->updateDocument($this->id, $this->document);
      $collection->save();
      return new NoContent();
    } catch (DocumentNotFound $e) {
      return new NotFound();
    } catch (InvalidDocument $e) {
      return new BadRequest();
    }
  }
}
