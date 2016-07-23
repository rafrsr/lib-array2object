<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Tests\Matcher;

use Rafrsr\LibArray2Object\Matcher\PropertyMatcherInterface;

/**
 * Class PropertyMatcherTester.
 */
abstract class PropertyMatcherTester extends \PHPUnit_Framework_TestCase
{
    public function testMatch()
    {
        $matcher = $this->buildMatcher();

        foreach ($this->getEquals() as $prop => $given) {
            $property = static::getMockBuilder(\ReflectionProperty::class)->disableOriginalConstructor()->getMock();
            $property->expects(static::any())->method('getName')->willReturn($prop);
            $msg = sprintf("property '%s' not match with '%s'", $prop, $given);
            static::assertTrue($matcher->match($property, $given), $msg);
        }

        foreach ($this->getNotEquals() as $prop => $given) {
            $property = static::getMockBuilder(\ReflectionProperty::class)->disableOriginalConstructor()->getMock();
            $property->expects(static::any())->method('getName')->willReturn($prop);
            $msg = sprintf("property '%s' match with '%s'", $prop, $given);
            static::assertFalse($matcher->match($property, $given), $msg);
        }
    }

    /**
     * buildMatcher.
     *
     * @return PropertyMatcherInterface
     */
    abstract public function buildMatcher();

    /**
     * getEquals.
     *
     * @return array
     */
    abstract public function getEquals();

    /**
     * getNotEquals.
     *
     * @return array
     */
    abstract public function getNotEquals();
}
