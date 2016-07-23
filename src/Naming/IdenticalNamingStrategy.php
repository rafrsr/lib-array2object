<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Naming;

class IdenticalNamingStrategy implements NamingStrategyInterface
{
    /**
     * {@inheritdoc}
     */
    public function transformName($name)
    {
        return $name;
    }
}
