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

use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccessorBuilder;

/**
 * Class AccessorWriter.
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
     * {@inheritdoc}
     */
    public function isWritable($object, $propertyPath)
    {
        return $this->accessor->isWritable($object, $propertyPath);
    }

    /**
     * {@inheritdoc}
     */
    public function setValue(&$object, $propertyPath, $value)
    {
        $this->accessor->setValue($object, $propertyPath, $value);
    }
}
