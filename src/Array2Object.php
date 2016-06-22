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
     * Array2Object constructor.
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
            $object->__populate($this, $data);
        } else {
            $reflClass = new \ReflectionClass($object);

            foreach ($this->getClassProperties($reflClass) as $property) {
                foreach ($data as $key => $value) {
                    if ($this->context->getMatcher()->match($property, $key)
                        && $this->context->getWriter()->isWritable($object, $property->getName())
                    ) {
                        $types = $this->getPropertyTypes($property);
                        $value = $this->parseValue($value, $types, $property, $object);
                        $this->context->getWriter()->setValue($object, $property->getName(), $value);
                    }
                }
            }
        }
    }

    /**
     * Get array of class properties including parents private properties
     *
     * @param \ReflectionClass $refClass
     *
     * @return array|\ReflectionProperty[]
     */
    private function getClassProperties(\ReflectionClass $refClass)
    {
        $props = $refClass->getProperties();
        $props_arr = [];
        foreach ($props as $prop) {
            $f = $prop->getName();

            $props_arr[$f] = $prop;
        }
        if ($parentClass = $refClass->getParentClass()) {
            $parent_props_arr = $this->getClassProperties($parentClass);//RECURSION
            if (count($parent_props_arr) > 0) {
                $props_arr = array_merge($parent_props_arr, $props_arr);
            }
        }

        return $props_arr;
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
                        foreach ($value as $key => &$arrayValue) {
                            $arrayValue = $parser->parseValue($arrayValue, str_replace('[]', null, $type), $property, $object);
                        }
                    } else {
                        $value = $parser->parseValue($value, $type, $property, $object);
                    }
                } else {
                    throw new \InvalidArgumentException(sprintf("%s is not a valid parser.", get_class($parser)));
                }
            }
        }

        return $value;
    }

    /**
     * @param \ReflectionProperty $property
     *
     * @return array
     */
    private function getPropertyTypes(\ReflectionProperty $property)
    {
        $doc = $property->getDocComment();
        preg_match('/@var\s([\w\\\|\[\]]+)/', $doc, $matches);
        $types = [];
        if (isset($matches[1])) {
            $types = explode('|', $matches[1]);
        }

        return $types;
    }
}