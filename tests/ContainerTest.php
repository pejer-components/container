<?php

use components\container\Container;
use components\container\ExceptionMissingObject;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
  public function testLoadingStdClass()
  {
    $container = new Container();
    $object = $container->get('StdClass');
    $this->assertInstanceOf('StdClass', $object);
  }

  public function testLoadingAlias()
  {
    $container = new Container();
    $container->register("Pejer", "StdClass");
    $object = $container->get('Pejer');
    $this->assertInstanceOf('StdClass', $object);
  }

  public function testLoadingMissingAliasOrClass()
  {
    $container = new Container();
    $container->register('felKlass', 'StdClassNoneExisting');
    $this->expectException(ExceptionMissingObject::class);
    $container->get('felKlass');
  }
}
