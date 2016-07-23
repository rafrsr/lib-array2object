<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Naming;

interface NamingStrategyInterface
{
    /**
     * Transform the origin name to use different version on target.
     *
     * @param string $name current name
     *
     * @return string
     */
    public function transformName($name);
}
