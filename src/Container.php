<?php

namespace components\container;

use components\container\ContainerInterface;


class Container implements ContainerInterface
{

  /** @var ResolveInterface */
  private $resolver = null;

  private $aliases = array();
  function __construct()
  {
    $this->resolver = new Resolve();
  }

  /**
   * Registers a class with a name
   *
   * @param string $alias the name/alias we want for the class
   * @param string $class the class, with namespace, that we should load
   */
  public function register(string $alias, string $class): bool
  {
    $this->aliases[$alias] = $class;
    return true;
  }

  /**
   * The name/alias we want to load
   */
  public function get(string $alias): object
  {
    $classToLoad = isset($this->aliases[$alias]) ? $this->aliases[$alias] : $alias;
    return $this->resolver->load($classToLoad);
  }
}
