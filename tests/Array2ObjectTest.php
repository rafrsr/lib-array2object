<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests;


use Rafrsr\LibArray2Object\Array2Object;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;

class Array2ObjectTest extends \PHPUnit_Framework_TestCase
{
    public function testArray2Object()
    {
        $teamArray
            = [
            'name' => 'Dream Team',
            'createdAt' => '2016-01-01',
            'points' => '25',
            'players' =>
                [
                    [
                        'name' => 'Player 1',
                        'number' => '1',
                        'height' => '1.80',
                        'regular' => 'true'
                    ],
                    [
                        'name' => 'Player 2',
                        'number' => '2',
                        'height' => '1.85',
                        'regular' => 'false'
                    ]
                ],
            'scores' => [
                '2016' => '29',
                '2015' => '28',
                '2014' => '30',
            ]

        ];

        /** @var Team $team */
        $team = Array2Object::createObject(Team::class, $teamArray);
        static::assertEquals('Dream Team', $team->getName());
        static::assertEquals(25, $team->getPoints());
        static::assertEquals(29, $team->getScores()[2016]);
        static::assertEquals('2016-01-01', $team->getCreatedAt()->format('Y-m-d'));

        static::assertEquals('Player 1', $team->getPlayers()[0]->getName());
        static::assertEquals(1, $team->getPlayers()[0]->getNumber());
        static::assertEquals(1.80, $team->getPlayers()[0]->getHeight());
        static::assertTrue($team->getPlayers()[0]->isRegular());

        static::assertEquals('Player 2', $team->getPlayers()[1]->getName());
        static::assertEquals(2, $team->getPlayers()[1]->getNumber());
        static::assertEquals(1.85, $team->getPlayers()[1]->getHeight());
        static::assertFalse($team->getPlayers()[1]->isRegular());

        static::assertInternalType('string', $team->getName());
        static::assertInternalType('integer', $team->getPoints());
        static::assertInternalType('boolean', $team->getPlayers()[0]->isRegular());
        static::assertInternalType('float', $team->getPlayers()[0]->getHeight());
    }
}
