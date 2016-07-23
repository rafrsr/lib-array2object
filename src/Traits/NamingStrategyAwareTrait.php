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

use Rafrsr\LibArray2Object\Naming\NamingStrategyInterface;

trait NamingStrategyAwareTrait
{
    /**
     * @var NamingStrategyInterface
     */
    private $namingStrategy;

    /**
     * @return NamingStrategyInterface
     */
    public function getNamingStrategy()
    {
        return $this->namingStrategy;
    }

    /**
     * @param NamingStrategyInterface $namingStrategy
     *
     * @return $this
     */
    public function setNamingStrategy(NamingStrategyInterface $namingStrategy)
    {
        $this->namingStrategy = $namingStrategy;

        return $this;
    }
}
