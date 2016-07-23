<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Traits;

/**
 * IgnoreNullsTrait.
 */
trait IgnoreNullsTrait
{
    /**
     * @var bool
     */
    private $ignoreNulls = true;

    /**
     * @return bool
     */
    public function isIgnoreNulls()
    {
        return $this->ignoreNulls;
    }

    /**
     * @param bool $ignoreNulls
     *
     * @return $this
     */
    public function setIgnoreNulls($ignoreNulls)
    {
        $this->ignoreNulls = $ignoreNulls;

        return $this;
    }
}
