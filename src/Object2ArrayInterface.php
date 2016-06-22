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
     * Create array from current object,
     * can use the $array2Object instance to create relations
     *
     * @param Object2Array $object2Array processor instance to populate
     *
     * @return array
     */
    public function __toArray(Object2Array $object2Array);
}