<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests;

use Rafrsr\LibArray2Object\Array2ObjectBuilder;
use Rafrsr\LibArray2Object\Tests\Fixtures\NameSpace1\Game;

/**
 * Class Array2ObjectInterfaceTest
 */
class Array2ObjectInterfaceTest extends \PHPUnit_Framework_TestCase
{
    public function testPopulate()
    {
        $gameArray = [
            'stadium' => 'National',
            'date' => '2016-01-01',
            'homeClub' => [
                'name' => 'Team 1'
            ],
            'visitor' => [
                'name' => 'Team 2'
            ]
        ];

        $array2Object = Array2ObjectBuilder::create()->build();

        /** @var Game $game */
        $game = $array2Object->createObject(Game::class, $gameArray);
        static::assertEquals('National', $game->getStadiumName());
        static::assertEquals('Team 1', $game->getHomeClub()->getName());
        static::assertEquals('Team 2', $game->getVisitor()->getName());
    }
}