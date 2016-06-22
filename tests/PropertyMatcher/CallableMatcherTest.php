<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\PropertyMatcher;

use Rafrsr\LibArray2Object\PropertyMatcher\CallableMatcher;

class CallableMatcherTest extends PropertyMatcherTester
{
    /**
     * @inheritDoc
     */
    public function buildMatcher()
    {
        return new CallableMatcher(
            function (\ReflectionProperty $property, $givenName) {
                return ($givenName === 'prueba' && $property->getName() === 'test');
            }
        );
    }

    /**
     * @inheritDoc
     */
    public function getEquals()
    {
        return [
            'test' => 'prueba'
        ];
    }

    /**
     * @inheritDoc
     */
    public function getNotEquals()
    {
        return [
            'test' => 'name'
        ];
    }
}