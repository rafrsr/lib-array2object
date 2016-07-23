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
