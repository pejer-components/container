<?php

namespace components\container;

use components\container\ContainerInterface;


class Container implements ContainerInterface
{

  /** @var ResolveInterface */
  private $resolver = null;

  private $aliases = array();

  private $objects = array();

  function __construct(array $aliases = null)
  {
    $this->resolver = new Resolve();
    if ($aliases != null) {
      $this->aliases = $aliases;
    }
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
  public function &get(string $alias): object
  {
    if (!isset($this->objects[$alias])) {
      $classToLoad = isset($this->aliases[$alias]) ? $this->aliases[$alias] : $alias;

      $this->objects[$alias] = $this->resolver->load($classToLoad);
    }
    return $this->objects[$alias];
  }
}
