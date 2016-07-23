<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Tests\Writer;

use Rafrsr\LibArray2Object\Tests\Fixtures\Team;
use Rafrsr\LibArray2Object\Writer\AccessorWriter;

class AccessorWriterTest extends \PHPUnit_Framework_TestCase
{
    public function testIsWritable()
    {
        $writer = new AccessorWriter();
        static::assertTrue($writer->isWritable(new Team(), 'name'));
        static::assertFalse($writer->isWritable(new Team(), 'id'));
    }

    public function testSetValue()
    {
        $writer = new AccessorWriter();
        $team = new Team();
        $writer->setValue($team, 'name', 'New Name');
        static::assertEquals('New Name', $team->getName());
    }
}
