<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests;

use Rafrsr\LibArray2Object\Object2ArrayBuilder;
use Rafrsr\LibArray2Object\Parser\CallableParser;
use Rafrsr\LibArray2Object\Tests\Fixtures\Manager;
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
                        $value = '$' . $value;
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
}
