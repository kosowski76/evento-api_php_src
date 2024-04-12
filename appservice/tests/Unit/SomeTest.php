<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

class SomeTest extends TestCase
{
    public function test_foo(): void {

        $this->assertTrue(true);
    }

    public function test_foo2(): void {

        $x = 5;
        $y = 3;
        
        $result = $x + $y;
        $this->assertEquals(8, $result);
    }
}

