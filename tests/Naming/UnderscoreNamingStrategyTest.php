<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\Naming;

use Rafrsr\LibArray2Object\Naming\UnderscoreNamingStrategy;

class UnderscoreNamingStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testTransformName()
    {
        $strategy = new UnderscoreNamingStrategy();
        static::assertEquals('test_property_name', $strategy->transformName('TestPropertyName'));
    }
}
