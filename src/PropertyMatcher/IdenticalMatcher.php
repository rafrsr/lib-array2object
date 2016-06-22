<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\PropertyMatcher;

class IdenticalMatcher implements PropertyMatcherInterface
{
    /**
     * @inheritDoc
     */
    public function match(\ReflectionProperty $property, $givenName)
    {
        return ($property->getName() === $givenName);
    }
}