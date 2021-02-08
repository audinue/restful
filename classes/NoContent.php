<?php

final class NoContent extends Response
{
  function __construct() {
    parent::__construct(204);
  }
}
