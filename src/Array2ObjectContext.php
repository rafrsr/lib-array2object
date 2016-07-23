<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
