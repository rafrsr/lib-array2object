<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\Reader;

use Rafrsr\LibArray2Object\Reader\AccessorReader;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;

class AccessorReaderTest extends \PHPUnit_Framework_TestCase
{

    public function testIsReadable()
    {
        $reader = new AccessorReader();
        static::assertTrue($reader->isReadable(new Team(), 'name'));
        static::assertTrue($reader->isReadable(new Team(), 'id'));
        static::assertFalse($reader->isReadable(new Team(), 'none'));
    }

    public function testGetValue()
    {
        $reader = new AccessorReader();
        $team = new Team();
        $team->setName('New Name');
        static::assertEquals('New Name', $reader->getValue($team, 'name'));
    }
}
