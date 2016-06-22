<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\Parser;

use Rafrsr\LibArray2Object\Array2ObjectContext;
use Rafrsr\LibArray2Object\Matcher\CamelizeMatcher;
use Rafrsr\LibArray2Object\Parser\ObjectParser;
use Rafrsr\LibArray2Object\Parser\StringParser;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;
use Rafrsr\LibArray2Object\Writer\AccessorWriter;

class ObjectParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $context = new Array2ObjectContext();
        $context->setWriter(new AccessorWriter());
        $context->setMatcher(new CamelizeMatcher());
        $context->setParsers([new StringParser()]);
        $parser = new ObjectParser($context);

        $object = new Team();
        $property = new \ReflectionProperty(get_class($object), 'name');

        /** @var Team $team */
        $team = $parser->parseValue(['name' => 'New Name'], 'Team', $property, $object);
        static::assertInstanceOf(Team::class, $team);
        static::assertEquals('New Name', $team->getName());
    }
}
