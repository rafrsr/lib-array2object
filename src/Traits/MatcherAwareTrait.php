<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Traits;

use Rafrsr\LibArray2Object\Matcher\PropertyMatcherInterface;

/**
 * MatcherAwareTrait.
 */
trait MatcherAwareTrait
{
    /**
     * @var PropertyMatcherInterface
     */
    private $matcher;

    /**
     * @return PropertyMatcherInterface
     */
    public function getMatcher()
    {
        return $this->matcher;
    }

    /**
     * @param PropertyMatcherInterface $matcher
     *
     * @return $this
     */
    public function setMatcher(PropertyMatcherInterface $matcher)
    {
        $this->matcher = $matcher;

        return $this;
    }
}
