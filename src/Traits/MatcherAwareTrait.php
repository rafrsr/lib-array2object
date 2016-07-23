<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
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
