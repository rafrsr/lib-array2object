<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Tests;

use Rafrsr\LibArray2Object\Object2ArrayBuilder;
use Rafrsr\LibArray2Object\Tests\Fixtures\NameSpace1\Game;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;

class Object2ArrayInterfaceTest extends \PHPUnit_Framework_TestCase
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
