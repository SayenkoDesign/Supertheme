<?php
namespace Tests;

class SimpleTest extends \PHPUnit_Framework_TestCase
{
    function testTrue()
    {
        $this->assertTrue(true, 'true does not equal true?');
    }
}