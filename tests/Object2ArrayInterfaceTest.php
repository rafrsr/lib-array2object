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
use Rafrsr\LibArray2Object\Object2ArrayBuilder;
use Rafrsr\LibArray2Object\Tests\Fixtures\NameSpace1\Game;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;

class Object2ArrayInterfaceTest extends TestCase
{
    public function testPopulate()
    {
        $game = new Game();
        $game->setStadiumName('National');
        $game->setDate(new \DateTime('2016-01-01'));
        $game->setHomeClub(new Team('Team 1'));
        $game->setVisitor(new Team('Team 2'));

        $objectToArray = Object2ArrayBuilder::create()->build();

        $array = $objectToArray->createArray($game);
        static::assertEquals($game->getStadiumName(), $array['stadium']);
        static::assertEquals('2016-01-01', $array['date']);
        static::assertEquals('Team 1', $array['homeClub']['name']);
        static::assertEquals('Team 2', $array['visitor']['name']);
    }
}
