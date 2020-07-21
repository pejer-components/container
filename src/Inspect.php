<?php

namespace components\container;

use components\container\InspectInterface;
use \ReflectionClass;

class Inspect implements InspectInterface
{
  /**
   * This will probe and inspect the class to extract some information about it.
   *
   * The information returned contains:
   * - Constructor and its parameters
   */
  public function inspect(string $class): array
  {
    $ClassReflection = new ReflectionClass($class);
    $ConstructorReflection = $ClassReflection->getConstructor();

    $return = [];
    foreach ($ConstructorReflection->getParameters() as $param) {
      $paramInfo = [
        "optional" => false,
        "defaultIsConstant" => false,
        "defaultValue" => null,
        "typeHint" => null
      ];

      $paramInfo["optional"] = $param->isOptional();
      if ($paramInfo["optional"] && $param->hasType()) {
        if ($param->getType() !== null) {
          $paramInfo["typeHint"] = $param->getType()->getName();
        } else {
          $paramInfo["typeHint"] = $param->getClass();
          $paramInfo["defaultIsConstant"] = $param->isDefaultValueConstant();
          $paramInfo["defaultValue"] = $param->getDefaultValue();
        }
      }
      $return[$param->getName()] = (object)$paramInfo;
    }
    return $return;
  }
}
