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
