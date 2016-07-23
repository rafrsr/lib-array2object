<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Tests\Naming;

use Rafrsr\LibArray2Object\Naming\CallableNamingStrategy;

class CallableNamingStrategyTest extends \PHPUnit_Framework_TestCase
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
