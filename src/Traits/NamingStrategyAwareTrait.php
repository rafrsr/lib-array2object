<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
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
