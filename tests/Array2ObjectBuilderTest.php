<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests;

use Rafrsr\LibArray2Object\Array2ObjectBuilder;
use Rafrsr\LibArray2Object\Array2ObjectContext;
use Rafrsr\LibArray2Object\Matcher\CamelizeMatcher;
use Rafrsr\LibArray2Object\Matcher\LevenshteinMatcher;
use Rafrsr\LibArray2Object\Parser\FloatParser;
use Rafrsr\LibArray2Object\Parser\IntegerParser;
use Rafrsr\LibArray2Object\Parser\StringParser;
use Rafrsr\LibArray2Object\Writer\AccessorWriter;
use Rafrsr\LibArray2Object\Writer\ReflectionWriter;

class Array2ObjectBuilderTest extends \PHPUnit_Framework_TestCase
{

    public function testCreate()
    {
        static::assertInstanceOf(Array2ObjectBuilder::class, Array2ObjectBuilder::create());
    }

    public function testGetSetContext()
    {
        $builder = Array2ObjectBuilder::create();
        $context = new Array2ObjectContext();
        $builder->setContext($context);
        static::assertEquals($context, $builder->getContext());
    }

    public function testGetSetParsers()
    {
        $builder = Array2ObjectBuilder::create();
        $parsers = [new StringParser(), new IntegerParser()];
        $builder->setParsers($parsers);

        static::assertEquals(['string' => new StringParser(), 'integer' => new IntegerParser()], $builder->getParsers());

        static::assertTrue($builder->hasParser('string'));
        static::assertTrue($builder->hasParser(new StringParser()));
        static::assertFalse($builder->hasParser(new FloatParser()));

        static::assertTrue($builder->hasParser('string'));
        $builder->removeParser('string');
        static::assertFalse($builder->hasParser('string'));

        static::assertTrue($builder->hasParser('integer'));
        $builder->removeParser(new IntegerParser());
        static::assertFalse($builder->hasParser('integer'));

        static::assertFalse($builder->hasParser('float'));
        $builder->addParser(new FloatParser());
        static::assertTrue($builder->hasParser('float'));
    }

    public function testDisableParsers()
    {
        $builder = Array2ObjectBuilder::create();
        $builder->disableParser(new StringParser());
        $builder->disableParser('integer');
        static::assertEquals(['string', 'integer'], $builder->getDisabledParsers());
    }

    public function testGetSetPropertyMatcher()
    {
        $builder = Array2ObjectBuilder::create();
        $matcher = new CamelizeMatcher();
        $builder->setPropertyMatcher($matcher);
        static::assertEquals($matcher, $builder->getPropertyMatcher());
    }

    public function testGetSetPropertyWriter()
    {
        $builder = Array2ObjectBuilder::create();
        $writer = new AccessorWriter();
        $builder->setPropertyWriter($writer);
        static::assertEquals($writer, $builder->getPropertyWriter());
    }

    public function testBuild()
    {
        //build basic
        $builder = Array2ObjectBuilder::create();
        $array2Object = $builder->build();

        static::assertEquals($array2Object->getContext()->getMatcher(), new CamelizeMatcher());
        static::assertEquals($array2Object->getContext()->getWriter(), new AccessorWriter());

        $parsers = $array2Object->getContext()->getParsers();

        foreach ($parsers as $name => $parser) {
            $builder->disableParser($name);
        }

        $builder->setPropertyMatcher(new LevenshteinMatcher());
        $builder->setPropertyWriter(new ReflectionWriter());

        $array2Object = $builder->build();

        static::assertEquals($array2Object->getContext()->getMatcher(), new LevenshteinMatcher());
        static::assertEquals($array2Object->getContext()->getWriter(), new ReflectionWriter());
        static::assertEmpty($array2Object->getContext()->getParsers());
    }
}
