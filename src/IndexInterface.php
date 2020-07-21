<?php

namespace components\container;

interface IndexInterface
{

  public function __construct(?array $interfaceIndex = [], ?array $classIndex = []);
  /**
   * Adds class to the index
   *
   * @param string $class the class to add to the index
   * @return bool
   */
  public function addClass(string $class): bool;

  /**
   * Adds a class and its interfaces.
   *
   * @param string $class the class to add
   * @param array $interfaces the interfaces this class implements
   * @return bool
   */
  public function add(string $class, array $interfaces): bool;

  /**
   * Resolves to the class that implements the interface
   *
   * This is a bit of a magix method. It will use the interface and try to find the class
   * that implements that interface. When there are more than one class that matches, we
   * weill use the second parameter as a hint to try to figure out which of the classes
   * we should load.
   *
   * If the second paramater isn't supplied or it wasn't usable - the first hit will be 
   * returned.
   *
   * @param string $interface the interface we want to resolve
   * @param ?string $namehint a hint as to what class it is we might want
   */
  public function resolveInterface(string $interface, ?string $nameHint = null);
}
