<?php

final class Server
{
  function respond() {
    try {
      $parser = new ActionParser();
      $action = $parser->parse();
      return $action->run(new Database());
    } catch (InvalidRequest $e) {
      return new BadRequest();
    }
  }
}
