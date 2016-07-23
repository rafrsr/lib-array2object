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

interface Array2ObjectInterface
{
    /**
     * Populate the object manually using the given data,.
     *
     * @param array $data array of data to populate the object
     *
     * @return mixed
     */
    public function __populate(array $data);
}
