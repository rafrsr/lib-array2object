<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Reader;

class ReflectionReader implements PropertyReaderInterface
{
    protected $onlyPublicProperties;

    /**
     * @param bool $onlyPublicProperties ignore private or protected properties
     */
    public function __construct($onlyPublicProperties = false)
    {
        $this->onlyPublicProperties = $onlyPublicProperties;
    }

    /**
     * {@inheritdoc}
     */
    public function isReadable($object, $propertyPath)
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
     * {@inheritdoc}
     */
    public function getValue($object, $propertyPath)
    {
        if ($this->isReadable($object, $propertyPath)) {
            $property = new \ReflectionProperty(get_class($object), $propertyPath);
            if (!$property->isPublic()) {
                $property->setAccessible(true);
            }

            return $property->getValue($object);
        }

        return;
    }
}
