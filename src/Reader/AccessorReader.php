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
    public function __construct(?PropertyAccessorBuilder $builder = null)
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
