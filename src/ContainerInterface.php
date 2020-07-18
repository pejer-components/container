<?php

namespace components\container;

interface ContainerInterface
{

  function register(string $alias, string $class): bool;

  function get(string $alias): object;
}
