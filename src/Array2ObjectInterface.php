<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object;

interface Array2ObjectInterface
{
    /**
     * Populate the object manually using the given data,
     * can use the $array2Object instance to populate relations
     *
     * @param Array2Object $array2Object processor instance to populate
     * @param array        $data         array of data to populate the object
     *
     * @return mixed
     */
    public function __populate(Array2Object $array2Object, array $data);
}