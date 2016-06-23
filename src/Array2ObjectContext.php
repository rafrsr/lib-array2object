<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object;

use Rafrsr\LibArray2Object\Traits\MatcherAwareTrait;
use Rafrsr\LibArray2Object\Writer\PropertyWriterInterface;

class Array2ObjectContext extends AbstractContext
{
    use MatcherAwareTrait;

    /**
     * @var PropertyWriterInterface
     */
    private $writer;

    /**
     * @return PropertyWriterInterface
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * @param PropertyWriterInterface $writer
     *
     * @return $this
     */
    public function setWriter($writer)
    {
        $this->writer = $writer;

        return $this;
    }
}