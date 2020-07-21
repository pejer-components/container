<?php

use components\container\Inspect;
use components\container\InspectInterface;
use PHPUnit\Framework\TestCase;

class InspectTest extends TestCase
{
  public function testInspectingStdClass()
  {
    $inspect = new Inspect();
    $constructorParams = $inspect->inspect('components\container\Container');
    $expectedValue = [
      "aliases" => (object)[
        'optional' => true,
        'defaultIsConstant' => false,
        'defaultValue' => null,
        'typeHint' => 'array'
      ]
    ];
    $this->assertEquals($expectedValue, $constructorParams);
  }
}
