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
