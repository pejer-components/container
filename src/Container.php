<?php

namespace components\container;

use components\container\ContainerInterface;
use components\container\Index;

class Container implements ContainerInterface
{
  /** @var IndexInterface */
  private $index = null;

  /** @var array */
  private $aliases = array(
    'index'   => 'components\container\Index'
  );

  /** @var array */
  private $objects = array();

  function __construct(array $aliases = null)
  {
    if ($aliases != null) {
      $this->aliases += $aliases;
    }
    $this->index = $this->get('index');
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

      $this->objects[$alias] = $this->load($classToLoad);
    }
    return $this->objects[$alias];
  }

  private function load(string $class, ...$args)
  {
    if (!$this->check($class)) {
      throw new ExceptionMissingObject("Unable to load that class");
    }
    # Get what the constructor excepts.
    $constructorDependencies = self::ConstructorDependencies($class);
    if (sizeof($args) == (sizeof($constructorDependencies['args']) - $constructorDependencies['optional'])) {
      return new $class(...$args);
    }
  }

  private function check(string $class)
  {
    return class_exists($class, true);
  }

  public static function ConstructorDependencies(string $class): array
  {
    $return = [
      "args" => [],
      "optional" => 0
    ];
    $ClassReflection = new \ReflectionClass($class);
    $ConstructorReflection = $ClassReflection->getConstructor();

    if (!empty($ConstructorReflection)) {

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

        if ($paramInfo['optional']) {
          ++$return["optional"];
        }

        $return['args'][$param->getName()] = (object)$paramInfo;
      }
    }
    return $return;
  }
}
