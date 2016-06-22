<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Writer;

use Symfony\Component\PropertyAccess\PropertyPathInterface;

/**
 * Class PropertyWriterInterface
 */
interface PropertyWriterInterface
{

    /**
     * Returns whether a value can be written at a given property path.
     *
     * @param object|array                 $object The object or array to check
     * @param string|PropertyPathInterface $propertyPath  The property path to check
     *
     * @return bool Whether the value can be set
     */
    public function isWritable($object, $propertyPath);

    /**
     * Sets the value at the end of the property path of the object graph.
     *
     * @param object|array                 $object The object or array to modify
     * @param string|PropertyPathInterface $propertyPath  The property path to modify
     * @param mixed                        $value         The value to set at the end of the property path
     *
     */
    public function setValue(&$object, $propertyPath, $value);
}