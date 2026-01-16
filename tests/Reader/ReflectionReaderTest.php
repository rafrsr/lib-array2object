<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Tests\Reader;

use PHPUnit\Framework\TestCase;
use Rafrsr\LibArray2Object\Reader\ReflectionReader;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;

class ReflectionReaderTest extends TestCase
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
