<?php

namespace components\container;

interface ResolveInterface
{
  /**
   * Resolves the class and returns it.
   *
   * @param string $class the name of the class with namespace
   */
  public function load(string $class): object;

  /**
   * Checks if we can resolve the class.
   *
   * @param string $class The class to try to resolve
   */
  public function check(string $class): bool;
}
