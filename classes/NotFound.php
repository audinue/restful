<?php

final class NotFound extends Response
{
  function __construct() {
    parent::__construct(404);
  }
}
