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

use Rafrsr\LibArray2Object\Naming\UnderscoreNamingStrategy;
use Rafrsr\LibArray2Object\Object2ArrayBuilder;
use Rafrsr\LibArray2Object\Parser\CallableParser;
use Rafrsr\LibArray2Object\Tests\Fixtures\NameSpace2\Manager;
use Rafrsr\LibArray2Object\Tests\Fixtures\Player;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;

class Object2ArrayTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateArray()
    {
        $team = new Team('Dream Team');
        $team->setCreatedAt(new \DateTime('2016-01-01'));

        $manager = new Manager();
        $manager->setName('Big Manager');
        $manager->setSalary('10000');
        $team->setManager($manager);

        $player1 = new Player();
        $player1->setName('Player 1');
        $player1->setNumber('1');
        $player1->setHeight('1.80');
        $team->setPlayers([$player1]);

        //register custom parser
        $object2Array = Object2ArrayBuilder::create()->addParser(
            new CallableParser(
                function ($value, $type, \ReflectionProperty $property, $object) {
                    if ($property->getName() === 'salary') {
                        $value = '$'.$value;
                    }

                    return $value;
                }
            )
        )->build();

        $array = $object2Array->createArray($team);
        static::assertEquals($team->getName(), $array['name']);
        static::assertEquals('2016-01-01 00:00:00', $array['createdAt']);
        static::assertEquals($manager->getName(), $array['manager']['name']);
        static::assertEquals('$10000', $array['manager']['salary']);
        static::assertEquals('Player 1', $array['players'][0]['name']);
    }

    public function testCreateArrayWithUnderScoreNamingStrategy()
    {
        $team = new Team('Dream Team');
        $team->setCreatedAt(new \DateTime('2016-01-01'));

        //register custom parser
        $object2Array = Object2ArrayBuilder::create()->setNamingStrategy(new UnderscoreNamingStrategy())->build();

        $array = $object2Array->createArray($team);
        static::assertEquals($team->getName(), $array['name']);
        static::assertEquals('2016-01-01 00:00:00', $array['created_at']);
    }

    public function testCreateArrayWithNulls()
    {
        $team = new Team('Dream Team');

        //register custom parser
        $object2Array = Object2ArrayBuilder::create()
            ->setIgnoreNulls(false)
            ->build();

        $array = $object2Array->createArray($team);

        static::assertEquals($team->getName(), $array['name']);
        static::assertNull($array['id']);
    }

    public function testSerializeJson()
    {
        $team = new Team('Dream Team');
        $team->setPlayers([new Player('Player 1', 1)]);
        $array = Object2ArrayBuilder::create()->build()->createArray($team);
        static::assertEquals('{"name":"Dream Team","manager":[],"players":[{"name":"Player 1","number":1}]}', json_encode($array));
    }
}
