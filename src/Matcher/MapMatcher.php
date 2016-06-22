<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Matcher;

/**
 * Class MapMatcher
 */
class MapMatcher implements PropertyMatcherInterface
{
    /**
     * @var array
     */
    protected $map;

    /**
     * MapMatcher constructor.
     *
     * @param array $map
     */
    public function __construct(array $map)
    {
        $this->map = $map;
    }

    /**
     * @inheritDoc
     */
    public function match(\ReflectionProperty $property, $givenName)
    {
        if (array_key_exists($property->getName(), $this->map)) {
            return ($this->map[$property->getName()] === $givenName);
        }

        return false;
    }
}