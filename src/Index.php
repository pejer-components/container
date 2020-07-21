<?php

namespace components\container;

use components\container\IndexInterface;

class Index implements IndexInterface
{

  /** @var array */
  private $interfaceIndex = [];

  /** @var array */
  private $classIndex = [];

  public function __construct(?array $interfaceIndex = [], ?array $classIndex = [])
  {
    $this->interfaceIndex = $interfaceIndex;
    $this->classIndex     = $classIndex;
  }

  public function add(string $class, array $interfaces): bool
  {
    $this->classIndex[$class] = $interfaces;
    foreach ($interfaces as $interface) {
      if (!isset($this->interfaceIndex[$interface])) {
        $this->interfaceIndex[$interface] = [];
      }
      $this->interfaceIndex[$interface][] = $class;
    }
    return true;
  }

  public function addClass(string $class): bool
  {
    $interfaces = class_implements($class);
    return $this->add($class, $interfaces);
  }

  public function resolveInterface(string $interface, ?string $nameHint = null)
  {
  }
}
