<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\Matcher;

use Rafrsr\LibArray2Object\Matcher\LevenshteinMatcher;

class LevenshteinMatcherTest extends PropertyMatcherTester
{

    /**
     * @inheritDoc
     */
    public function buildMatcher()
    {
        return new LevenshteinMatcher();
    }

    /**
     * @inheritDoc
     */
    public function getEquals()
    {
        return [
            'test' => 'Test',
            'test_property' => 'TestProperty',
            'test_properti' => 'TestProperty',
            'testing' => 'test_ng'
        ];
    }

    /**
     * @inheritDoc
     */
    public function getNotEquals()
    {
        return [
            'testing' => 'test',
            'test_prop' => 'test_node',
        ];
    }
}
