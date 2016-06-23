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
     *
     * @param array $data array of data to populate the object
     *
     * @return mixed
     */
    public function __populate(array $data);
}