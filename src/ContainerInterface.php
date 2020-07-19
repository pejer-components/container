<?php

namespace components\container;

interface ContainerInterface
{

  public function register(string $alias, string $class): bool;

  public function get(string $alias): object;
}
