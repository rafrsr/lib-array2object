<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Matcher;

interface PropertyMatcherInterface
{
    /**
     * Should compare two property names and return true if are the same.
     *
     * @param \ReflectionProperty $property
     * @param string              $givenName
     *
     * @return bool
     */
    public function match(\ReflectionProperty $property, $givenName);
}
