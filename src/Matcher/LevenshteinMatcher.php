<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Matcher;

class LevenshteinMatcher implements PropertyMatcherInterface
{
    /**
     * {@inheritdoc}
     */
    public function match(\ReflectionProperty $property, $givenName)
    {
        $lev = levenshtein($property->getName(), $givenName);

        return $lev <= strlen($property->getName()) / 3;
    }
}
