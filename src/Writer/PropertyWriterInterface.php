<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Writer;

use Symfony\Component\PropertyAccess\PropertyPathInterface;

/**
 * Class PropertyWriterInterface.
 */
interface PropertyWriterInterface
{
    /**
     * Returns whether a value can be written at a given property path.
     *
     * @param object|array                 $object       The object or array to check
     * @param string|PropertyPathInterface $propertyPath The property path to check
     *
     * @return bool Whether the value can be set
     */
    public function isWritable($object, $propertyPath);

    /**
     * Sets the value at the end of the property path of the object graph.
     *
     * @param object|array                 $object       The object or array to modify
     * @param string|PropertyPathInterface $propertyPath The property path to modify
     * @param mixed                        $value        The value to set at the end of the property path
     */
    public function setValue(&$object, $propertyPath, $value);
}
