<?php

namespace components\container;

interface InspectInterface
{
  public function inspect(string $class): array;
}
