<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object;

use Rafrsr\LibArray2Object\Reader\PropertyReaderInterface;
use Rafrsr\LibArray2Object\Traits\IgnoreNullsTrait;
use Rafrsr\LibArray2Object\Traits\NamingStrategyAwareTrait;

class Object2ArrayContext extends AbstractContext
{
    use NamingStrategyAwareTrait;
    use IgnoreNullsTrait;

    /**
     * @var PropertyReaderInterface
     */
    private $reader;

    /**
     * @return PropertyReaderInterface
     */
    public function getReader()
    {
        return $this->reader;
    }

    /**
     * @param PropertyReaderInterface $reader
     *
     * @return $this
     */
    public function setReader($reader)
    {
        $this->reader = $reader;

        return $this;
    }    
}