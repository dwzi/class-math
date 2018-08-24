<?php

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase {

  public function testAdd() {

    $Math = new DWZI\Library\Math();
    $result = $Math->add(1, 2);

		$this->assertEquals(3, $result);
  }

  public function testAddException() {

    $Math = new DWZI\Library\Math();
    $result = $Math->add(1, 'invalid');
  }
}
