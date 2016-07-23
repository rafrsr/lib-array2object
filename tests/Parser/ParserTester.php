<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Tests\Parser;

use Rafrsr\LibArray2Object\Parser\ValueParserInterface;

/**
 * Class ParserTester.
 */
abstract class ParserTester extends \PHPUnit_Framework_TestCase
{
    /**
     * @return ValueParserInterface
     */
    abstract public function buildParser();

    /**
     * @return array
     */
    abstract public function getParseValueMap();

    /**
     * @return array
     */
    abstract public function getTypes();

    public function testParse()
    {
        $parser = $this->buildParser();

        foreach ($this->getParseValueMap() as $origin => $expectedParsed) {
            foreach ($this->getTypes() as $type) {
                $property = static::getMockBuilder(\ReflectionProperty::class)->disableOriginalConstructor()->getMock();
                $parsed = $parser->toObjectValue($origin, $type, $property, new \stdClass());
                static::assertEquals($expectedParsed, $parsed);
            }
        }
    }
}
