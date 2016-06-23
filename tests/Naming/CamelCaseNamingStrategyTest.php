<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\Naming;

use Rafrsr\LibArray2Object\Naming\CamelCaseNamingStrategy;

class CamelCaseNamingStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testTransformName()
    {
        $strategy = new CamelCaseNamingStrategy();
        static::assertEquals('testNameProperty', $strategy->transformName('test_name_property'));

        $strategy = new CamelCaseNamingStrategy(true);
        static::assertEquals('TestNameProperty', $strategy->transformName('test_name_property'));
    }
}
