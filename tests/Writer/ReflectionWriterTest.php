<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Tests\Writer;

use PHPUnit\Framework\TestCase;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;
use Rafrsr\LibArray2Object\Writer\ReflectionWriter;

class ReflectionWriterTest extends TestCase
{
    public function testIsWritable()
    {
        $writer = new ReflectionWriter();
        static::assertTrue($writer->isWritable(new Team(), 'name'));
        static::assertTrue($writer->isWritable(new Team(), 'id'));
        static::assertFalse($writer->isWritable(new Team(), 'lastName'));
    }

    public function testSetValue()
    {
        $writer = new ReflectionWriter();
        $team = new Team();
        $writer->setValue($team, 'name', 'New Name');
        static::assertEquals('New Name', $team->getName());

        $writer->setValue($team, 'id', 1);
        static::assertEquals(1, $team->getId());
    }
}
