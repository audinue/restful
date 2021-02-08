<?php

final class ActionParser
{
  private function parseDocument() {
    $contents = @file_get_contents('php://input');
    $data = @json_decode($contents);
    if (!is_object($data)) {
      throw new InvalidRequest();
    }
    return $data;
  }

  function parse() {
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'GET':
        if (preg_match('@^/([a-z0-9]+)$@', $_SERVER['PATH_INFO'], $match)) {
          return new GetCollection($match[1]);
        } elseif (preg_match('@^/([a-z0-9]+)/(\d+)$@', $_SERVER['PATH_INFO'], $match)) {
          return new GetDocument($match[1], $match[2]);
        } else {
          throw new InvalidRequest();
        }
        break;
      case 'POST':
        if (preg_match('@^/([a-z0-9]+)$@', $_SERVER['PATH_INFO'], $match)) {
          return new CreateDocument($match[1], $this->parseDocument());
        } else {
          throw new InvalidRequest();
        }
        break;
      case 'PUT':
        if (preg_match('@^/([a-z0-9]+)/(\d+)$@', $_SERVER['PATH_INFO'], $match)) {
          return new UpdateDocument($match[1], $match[2], $this->parseDocument());
        } else {
          throw new InvalidRequest();
        }
        break;
      case 'DELETE':
        if (preg_match('@^/([a-z0-9]+)/(\d+)$@', $_SERVER['PATH_INFO'], $match)) {
          return new DeleteDocument($match[1], $match[2]);
        } else {
          throw new InvalidRequest();
        }
        break;
      default:
        throw new InvalidRequest();
    }
  }
}
