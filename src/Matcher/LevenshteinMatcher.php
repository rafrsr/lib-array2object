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
