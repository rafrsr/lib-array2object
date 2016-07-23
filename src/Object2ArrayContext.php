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
