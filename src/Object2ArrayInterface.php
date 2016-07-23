<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object;

interface Object2ArrayInterface
{
    /**
     * Create array from current object,.
     *
     * @return array
     */
    public function __toArray();
}
