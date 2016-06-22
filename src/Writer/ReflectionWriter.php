<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Writer;

/**
 * Class ReflectionWriter
 */
class ReflectionWriter implements PropertyWriterInterface
{

    protected $onlyPublicProperties;

    /**
     * @param boolean $onlyPublicProperties ignore private or protected properties
     */
    public function __construct($onlyPublicProperties = false)
    {
        $this->onlyPublicProperties = $onlyPublicProperties;
    }

    /**
     * @inheritDoc
     */
    public function isWritable($object, $propertyPath)
    {
        $classRef = new \ReflectionClass(get_class($object));

        if (!$classRef->hasProperty($propertyPath)) {
            return false;
        }

        $property = $classRef->getProperty($propertyPath);
        if ($this->onlyPublicProperties && !$property->isPublic()) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function setValue(&$object, $propertyPath, $value)
    {
        if ($this->isWritable($object, $propertyPath)) {
            $property = new \ReflectionProperty(get_class($object), $propertyPath);
            if (!$property->isPublic()) {
                $property->setAccessible(true);
            }

            $property->setValue($object, $value);
        }
    }
}