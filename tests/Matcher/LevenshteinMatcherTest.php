<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Tests\Matcher;

use Rafrsr\LibArray2Object\Matcher\LevenshteinMatcher;

class LevenshteinMatcherTest extends PropertyMatcherTester
{
    /**
     * {@inheritdoc}
     */
    public function buildMatcher()
    {
        return new LevenshteinMatcher();
    }

    /**
     * {@inheritdoc}
     */
    public function getEquals()
    {
        return [
            'test' => 'Test',
            'test_property' => 'TestProperty',
            'test_properti' => 'TestProperty',
            'testing' => 'test_ng',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getNotEquals()
    {
        return [
            'testing' => 'test',
            'test_prop' => 'test_node',
        ];
    }
}
