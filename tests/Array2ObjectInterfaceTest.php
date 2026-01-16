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

use PHPUnit\Framework\TestCase;
use Rafrsr\LibArray2Object\Array2ObjectBuilder;
use Rafrsr\LibArray2Object\Tests\Fixtures\NameSpace1\Game;

/**
 * Class Array2ObjectInterfaceTest.
 */
class Array2ObjectInterfaceTest extends TestCase
{
    public function testPopulate()
    {
        $gameArray = [
            'stadium' => 'National',
            'date' => '2016-01-01',
            'homeClub' => [
                'name' => 'Team 1',
            ],
            'visitor' => [
                'name' => 'Team 2',
            ],
        ];

        $array2Object = Array2ObjectBuilder::create()->build();

        /** @var Game $game */
        $game = $array2Object->createObject(Game::class, $gameArray);
        static::assertEquals('National', $game->getStadiumName());
        static::assertEquals('Team 1', $game->getHomeClub()->getName());
        static::assertEquals('Team 2', $game->getVisitor()->getName());
    }
}
