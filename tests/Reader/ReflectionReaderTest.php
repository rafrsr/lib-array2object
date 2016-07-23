<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Tests\Reader;

use Rafrsr\LibArray2Object\Reader\ReflectionReader;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;

class ReflectionReaderTest extends \PHPUnit_Framework_TestCase
{
    public function testIsReadable()
    {
        $reader = new ReflectionReader();
        static::assertTrue($reader->isReadable(new Team(), 'name'));
        static::assertFalse($reader->isReadable(new Team(), 'none'));

        $reader = new ReflectionReader(true);
        static::assertFalse($reader->isReadable(new Team(), 'name'));
    }

    public function testGetValue()
    {
        $reader = new ReflectionReader();
        $team = new Team();
        $team->setName('New Name');
        static::assertEquals('New Name', $reader->getValue($team, 'name'));

        $reader = new ReflectionReader(true);
        static::assertNull($reader->getValue($team, 'name'));
    }
}
