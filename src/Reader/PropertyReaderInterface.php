<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Reader;

use Symfony\Component\PropertyAccess\PropertyPathInterface;

interface PropertyReaderInterface
{
    /**
     * Returns whether a property path can be read from an object graph.
     *
     * @param object|array                 $object       The object to check
     * @param string|PropertyPathInterface $propertyPath The property path to check
     *
     * @return bool Whether the property path can be read
     */
    public function isReadable($object, $propertyPath);

    /**
     * Returns the value at the end of the property path of the object graph.
     *
     * @param object|array                 $object       The object to traverse
     * @param string|PropertyPathInterface $propertyPath The property path to read
     *
     * @return mixed The value at the end of the property path
     */
    public function getValue($object, $propertyPath);
}
