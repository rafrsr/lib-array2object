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

use PHPUnit\Framework\TestCase;
use Rafrsr\LibArray2Object\Array2ObjectContext;
use Rafrsr\LibArray2Object\Matcher\CamelizeMatcher;
use Rafrsr\LibArray2Object\Parser\ObjectParser;
use Rafrsr\LibArray2Object\Parser\StringParser;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;
use Rafrsr\LibArray2Object\Writer\AccessorWriter;

class ObjectParserTest extends TestCase
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
        $team = $parser->toObjectValue(['name' => 'New Name'], 'Team', $property, $object);
        static::assertInstanceOf(Team::class, $team);
        static::assertEquals('New Name', $team->getName());
    }
}
