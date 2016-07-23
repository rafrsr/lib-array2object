<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
