<?php

namespace components\container;


class Resolve implements ResolveInterface
{
  public function load(string $class): object
  {
    if (!$this->check($class)) {
      throw new ExceptionMissingObject("Unable to load that class");
    }

    $return = new $class();
    return $return;
  }

  public function check(string $class): bool
  {
    return class_exists($class, true);
  }
}
