<?php

use components\container\ExceptionMissingObject;
use components\container\Resolve;
use PHPUnit\Framework\TestCase;

class ResolveTest extends TestCase
{
  public function testResolveStdClass()
  {
    $resolve = new Resolve();
    $object = $resolve->load('StdClass');
    $this->assertInstanceOf('StdClass', $object);
  }
  public function testResolveWrongClass()
  {
    $resolve = new Resolve();
    $this->expectException(ExceptionMissingObject::class);

    $resolve->load('StdClassNoneExisting');
  }
}
