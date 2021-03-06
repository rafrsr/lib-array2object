<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Tests;

use Rafrsr\LibArray2Object\Array2ObjectContext;
use Rafrsr\LibArray2Object\Matcher\CamelizeMatcher;
use Rafrsr\LibArray2Object\Parser\IntegerParser;
use Rafrsr\LibArray2Object\Parser\StringParser;
use Rafrsr\LibArray2Object\Writer\AccessorWriter;

class Array2ObjectContextTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSetParsers()
    {
        $context = new Array2ObjectContext();
        $parsers = [new StringParser(), new IntegerParser()];
        $context->setParsers($parsers);

        static::assertEquals(['string' => new StringParser(), 'integer' => new IntegerParser()], $context->getParsers());
    }

    public function testAppendParsers()
    {
        $context = new Array2ObjectContext();
        $parsers = [new StringParser()];
        $context->setParsers($parsers);
        $context->appendParser(new IntegerParser());
        static::assertEquals(['string' => new StringParser(), 'integer' => new IntegerParser()], $context->getParsers());
    }

    public function testPrependParsers()
    {
        $context = new Array2ObjectContext();
        $parsers = [new StringParser(), new IntegerParser()];
        $context->setParsers($parsers);
        $context->prependParser(new IntegerParser());
        static::assertEquals(['integer' => new IntegerParser(), 'string' => new StringParser()], $context->getParsers());
    }

    public function testGetSetPropertyMatcher()
    {
        $context = new Array2ObjectContext();
        $matcher = new CamelizeMatcher();
        $context->setMatcher($matcher);
        static::assertEquals($matcher, $context->getMatcher());
    }

    public function testGetSetPropertyWriter()
    {
        $context = new Array2ObjectContext();
        $writer = new AccessorWriter();
        $context->setWriter($writer);
        static::assertEquals($writer, $context->getWriter());
    }
}
