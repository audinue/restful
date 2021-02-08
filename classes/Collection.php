<?php

final class Collection
{
  private $name;
  private $count;
  private $documents;

  function __construct($name, $count = 0, $documents = []) {
    $this->name = $name;
    $this->count = $count;
    $this->documents = $documents;
  }

  function getDocuments() {
    return array_values($this->documents);
  }

  function getDocumentById($id) {
    if (isset($this->documents[$id])) {
      return $this->documents[$id];
    } else {
      throw new DocumentNotFound();
    }
  }

  function createDocument($document) {
    if (isset($document->id)) {
      throw new InvalidDocument();
    } else {
      $id = ++$this->count;
      $document->id = $id;
      $this->documents[$document->id] = $document;
      return $document->id;
    }
  }

  function updateDocument($id, $document) {
    if (isset($document->id)) {
      if ($document->id == $id) {
        if (isset($this->documents[$id])) {
          $this->documents[$id] = $document;
        } else {
          throw new DocumentNotFound();
        }
      } else {
        throw new InvalidDocument();
      }
    } else {
      throw new InvalidDocument();
    }
  }

  function deleteDocument($id) {
    if (isset($this->documents[$id])) {
      unset($this->documents[$id]);
    } else {
      throw new DocumentNotFound();
    }
  }

  function save() {
    $file = $this->name . '.json';
    $data = (object) [
      'count' => $this->count,
      'documents' => $this->documents
    ];
    $contents = json_encode($data);
    file_put_contents($file, $contents);
  }
}
