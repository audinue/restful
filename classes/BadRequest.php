<?php

final class BadRequest extends Response
{
  function __construct() {
    parent::__construct(400);
  }
}
