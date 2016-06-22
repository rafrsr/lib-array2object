<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object;

use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Using the property names and the common property annotations
 * populate a object instance with the values of the array recursively
 */
class Array2Object
{

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
    static public function createObject($class, array $data)
    {
        if (is_string($class) && class_exists($class)) {
            $object = new $class;
        } else {
            $object = new $class;
        }

        self::populate($object, $data);

        return $object;
    }

    /**
     * @param object $object object instance to populate
     * @param array  $data   array of data to apply
     *
     * @throws \InvalidArgumentException
     */
    static public function populate($object, array $data)
    {
        if (!is_object($object)) {
            throw new \InvalidArgumentException('The first param should be a object.');
        }

        $propertyAccessor = new PropertyAccessor();

        $reflClass = new \ReflectionClass($object);

        foreach (self::getClassProperties($reflClass) as $property) {
            foreach ($data as $key => $value) {
                if ($propertyAccessor->isWritable($object, $key) && self::isSameProperty($property->getName(), $key)) {
                    $types = self::getPropertyTypes($property);
                    $value = self::parseValue($value, $types, new \ReflectionClass($property->class));
                    $propertyAccessor->setValue($object, $key, $value);
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
    static private function getClassProperties(\ReflectionClass $refClass)
    {
        $props = $refClass->getProperties();
        $props_arr = [];
        foreach ($props as $prop) {
            $f = $prop->getName();

            $props_arr[$f] = $prop;
        }
        if ($parentClass = $refClass->getParentClass()) {
            $parent_props_arr = self::getClassProperties($parentClass);//RECURSION
            if (count($parent_props_arr) > 0) {
                $props_arr = array_merge($parent_props_arr, $props_arr);
            }
        }

        return $props_arr;
    }

    /**
     * @param $propertyName
     * @param $givenName
     *
     * @return bool
     */
    static private function isSameProperty($propertyName, $givenName)
    {
        if ($propertyName === $givenName
            || $propertyName === self::camelize($givenName) //ErrorCode = error_code
            || $propertyName === lcfirst(self::camelize($givenName)) // errorCode => error_code
            || $propertyName === strtolower(self::camelize($givenName)) // errorcode => error_code
            || strtolower($propertyName) === $givenName // errorCode => errorcode
        ) {
            return true;
        }

        return false;
    }

    /**
     * Parse a value using given types
     *
     * @param mixed            $value
     * @param array            $types
     * @param \ReflectionClass $context
     *
     * @return array|bool|float|int|string
     */
    static private function parseValue($value, $types, \ReflectionClass $context)
    {
        foreach ($types as $type) {

            switch ($type) {
                case 'string':
                    $value = (string)$value;
                    break;
                case 'integer':
                case 'int':
                    $value = (integer)$value;
                    break;
                case 'float':
                case 'double':
                    $value = (float)$value;
                    break;
                case 'bool':
                case 'boolean':
                    if (is_string($value)) {
                        switch (strtoupper($value)) {
                            case 'true':
                            case 'yes':
                                $value = true;
                                break;
                            case 'false':
                            case 'no':
                                $value = false;
                                break;
                            default:
                                $value = (boolean)$value;
                        }
                    } else {
                        $value = (boolean)$value;
                    }
                    break;
                case '\DateTime':
                case 'DateTime':
                    $value = new $type($value);
                    break;
                case 'array':
                    if (is_array($value)) {
                        foreach ($value as $key => $arrayValue) {
                            $arrayType = [];
                            if (array_key_exists(1, $types) && $types[1] !== 'array') {
                                $arrayType = str_replace('[]', null, $types[1]);
                            }
                            $value[$key] = self::parseValue($arrayValue, [$arrayType], $context);
                        }
                    }
                    break;
                default:
                    $value = self::valueToObject($value, $type, $context);

            }
        }

        return $value;
    }

    /**
     * Convert a array value into a object or array of objects
     *
     * @param  mixed           $value
     * @param  string          $type
     * @param \ReflectionClass $context
     *
     * @return array
     */
    static private function valueToObject($value, $type, \ReflectionClass $context)
    {
        $isArrayOfObjects = (strpos($type, '[]') !== false);
        $type = str_replace('[]', null, $type);
        $className = null;

        //use the type as class
        if (class_exists($type)) {
            $className = $type;
        }

        //try to get the class from use statements in the class file
        if ($className === null) {
            $classContent = file_get_contents($context->getFileName());
            preg_match("/use\s+([\w\\\]+$type);/", $classContent, $matches);
            if (isset($matches[1]) && class_exists($matches[1])) {
                $className = $matches[1];
            }
        }

        //use the same namespace as class container
        if ($className === null && class_exists($context->getNamespaceName() . "\\" . $type)) {
            $className = $context->getNamespaceName() . "\\" . $type;
        }

        if (is_array($value) && $className !== null && class_exists($className)) {
            //array of objects
            if ($isArrayOfObjects) {
                $newValue = [];
                foreach ($value as $key => $item) {
                    if (is_array($item)) {
                        $newValue[$key] = self::createObject($className, $value);
                    } else {
                        $newValue[$key] = $item;
                    }
                }
            } else { //simple object
                $newValue = self::createObject($className, $value);
            }
        }

        if (isset($newValue)) {
            $value = $newValue;
        }

        return $value;
    }

    /**
     * @param $name
     *
     * @return string
     */
    static private function camelize($name)
    {
        return strtr(ucwords(strtr($name, ['_' => ' '])), [' ' => '']);
    }

    /**
     * @param \ReflectionProperty $property
     *
     * @return array
     */
    static private function getPropertyTypes(\ReflectionProperty $property)
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