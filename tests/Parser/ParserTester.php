<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
