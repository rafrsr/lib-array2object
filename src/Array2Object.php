<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object;

use Rafrsr\LibArray2Object\Parser\ValueParserInterface;

/**
 * Using the property names and the common property annotations
 * populate a object instance with the values of the array recursively
 */
class Array2Object
{
    /**
     * @var Array2ObjectContext
     */
    private $context;

    /**
     * @param Array2ObjectContext $context
     */
    public function __construct(Array2ObjectContext $context)
    {
        $this->context = $context;
    }

    /**
     * @return Array2ObjectContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param Array2ObjectContext $context
     *
     * @return $this
     */
    public function setContext(Array2ObjectContext $context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * createObject
     *
     * @param string $class class to create object or instance
     * @param array  $data  array of data
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function createObject($class, array $data)
    {
        if (is_string($class) && class_exists($class)) {
            $object = new $class;
        } else {
            throw new \InvalidArgumentException('The first argument should be a valid class, can use ::populate with objects');
        }

        $this->populate($object, $data);

        return $object;
    }

    /**
     * @param object $object object instance to populate
     * @param array  $data   array of data to apply
     *
     * @throws \InvalidArgumentException
     */
    public function populate($object, array $data)
    {
        if (!is_object($object)) {
            throw new \InvalidArgumentException('The first param should be a object.');
        }

        if ($object instanceof Array2ObjectInterface) {
            $object->__populate($data);
        } else {
            $reflClass = new \ReflectionClass($object);
            foreach (Utils::getClassProperties($reflClass) as $property) {
                foreach ($data as $key => $value) {
                    if ($this->context->getMatcher()->match($property, $key)
                        && $this->context->getWriter()->isWritable($object, $property->getName())
                    ) {
                        $types = Utils::getPropertyTypes($property);
                        $value = $this->parseValue($value, $types, $property, $object);
                        $this->context->getWriter()->setValue($object, $property->getName(), $value);
                    }
                }
            }
        }
    }

    /**
     * Parse a value using given types
     *
     * @param mixed               $value
     * @param array               $types
     * @param \ReflectionProperty $property
     * @param object              $object
     *
     * @return array|bool|float|int|string
     */
    private function parseValue($value, $types, \ReflectionProperty $property, $object)
    {
        foreach ($types as $type) {

            foreach ($this->context->getParsers() as $parser) {
                if ($parser instanceof ValueParserInterface) {
                    if (is_array($value) && strpos($type, '[]') !== false) {

                        //support for nesting children
                        //https://github.com/rafrsr/lib-array2object/issues/1
                        if (count($value) === 1 && is_array(current($value)) && array_key_exists(0, current($value))) {
                            $value = current($value);
                        }

                        foreach ($value as $key => &$arrayValue) {
                            $arrayValue = $parser->toObjectValue($arrayValue, str_replace('[]', null, $type), $property, $object);
                        }
                    } else {
                        $value = $parser->toObjectValue($value, str_replace('[]', null, $type), $property, $object);
                    }
                } else {
                    throw new \InvalidArgumentException(sprintf("%s is not a valid parser.", get_class($parser)));
                }
            }
        }

        return $value;
    }
}