<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Reader;

use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccessorBuilder;

class AccessorReader implements PropertyReaderInterface
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
     * {@inheritdoc}
     */
    public function isReadable($object, $propertyPath)
    {
        return $this->accessor->isReadable($object, $propertyPath);
    }

    /**
     * {@inheritdoc}
     */
    public function getValue($object, $propertyPath)
    {
        return $this->accessor->getValue($object, $propertyPath);
    }
}
