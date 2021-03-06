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
