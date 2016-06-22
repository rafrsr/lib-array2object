<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Writer;

use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccessorBuilder;

/**
 * Class AccessorWriter
 */
class AccessorWriter implements PropertyWriterInterface
{

    /**
     * @var PropertyAccessor
     */
    protected $accessor;

    /**
     * AccessorWriter constructor.
     *
     * @param PropertyAccessorBuilder|null $builder
     */
    public function __construct(PropertyAccessorBuilder $builder = null)
    {
        if (!$builder) {
            $builder = new PropertyAccessorBuilder();
        }

        $this->accessor = $builder->getPropertyAccessor();
    }


    /**
     * @inheritDoc
     */
    public function isWritable($object, $propertyPath)
    {
        return $this->accessor->isWritable($object, $propertyPath);
    }

    /**
     * @inheritDoc
     */
    public function setValue(&$object, $propertyPath, $value)
    {
        $this->accessor->setValue($object, $propertyPath, $value);
    }
}