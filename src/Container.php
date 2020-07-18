<?php

namespace components\container;

use components\container\ContainerInterface;


class Container implements ContainerInterface
{

  function __construct()
  {
    echo "This is the one we actually want!";
  }

  /**
   * Registers a class with a name
   *
   * @param string $alias the name/alias we want for the class
   * @param string $class the class, with namespace, that we should load
   */
  function register(string $alias, string $class): bool
  {
    return true;
  }

  /**
   * The name/alias we want to load
   */
  function get(string $alias): object
  {
  }
}
