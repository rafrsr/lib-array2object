<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\PropertyMatcher;

use Rafrsr\LibArray2Object\PropertyMatcher\MapMatcher;

class MapMatcherTest extends PropertyMatcherTester
{
    /**
     * @inheritDoc
     */
    public function buildMatcher()
    {
        return new MapMatcher(
            [
                'test' => 'prueba',
                'name' => 'nombre'
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function getEquals()
    {
        return [
            'test' => 'prueba',
            'name' => 'nombre',
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