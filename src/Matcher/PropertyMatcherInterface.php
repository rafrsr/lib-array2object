<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Matcher;

interface PropertyMatcherInterface
{
    /**
     * Should compare two property names and return true if are the same
     *
     * @param \ReflectionProperty $property
     * @param string              $givenName
     *
     * @return boolean
     */
    public function match(\ReflectionProperty $property, $givenName);
}