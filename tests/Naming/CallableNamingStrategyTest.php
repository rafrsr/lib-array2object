<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Tests\Naming;

use PHPUnit\Framework\TestCase;
use Rafrsr\LibArray2Object\Naming\CallableNamingStrategy;

class CallableNamingStrategyTest extends TestCase
{
    public function testTransformName()
    {
        $strategy = new CallableNamingStrategy(
            function ($name) {
                return strtoupper($name);
            }
        );
        static::assertEquals('TEST', $strategy->transformName('test'));

        $strategy = new CallableNamingStrategy('strtolower');
        static::assertEquals('test', $strategy->transformName('TEST'));

        $strategy = new CallableNamingStrategy([$this, 'transform']);
        static::assertEquals('Test', $strategy->transformName('test'));
    }

    public function transform($name)
    {
        return ucfirst($name);
    }
}
