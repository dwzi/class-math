<?php

use PHPUnit\Framework\TestCase;

class MathBCMathTest extends TestCase {

  public function testAdd() {

    $Math = new DWZI\Library\MathBCMath();
    $result = $Math->add('1', '2');

		$this->assertEquals('3.00', $result);
  }

  public function testAddException() {

    $Math = new DWZI\Library\MathBCMath();
    $result = $Math->add('1', 'invalid');
  }
}
