<?php

namespace App\Database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class FisrtTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    public function setUp():void
    {
        parent::setUp();

        // Do something here....
    }

    public function tearDown():void
    {
        parent::tearDown();

        // Do something here....
    }

    public function testIfThisWorks(){
        $stack = [];
        $this->assertSame(0, count($stack));
    }
}
