<?php

final class Ok extends Response
{
  function __construct($body) {
    parent::__construct(200, json_encode($body));
  }
}
