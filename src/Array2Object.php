<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object;

use Rafrsr\LibArray2Object\Parser\BooleanParser;
use Rafrsr\LibArray2Object\Parser\DateTimeParser;
use Rafrsr\LibArray2Object\Parser\FloatParser;
use Rafrsr\LibArray2Object\Parser\IntegerParser;
use Rafrsr\LibArray2Object\Parser\ObjectParser;
use Rafrsr\LibArray2Object\Parser\StringParser;
use Rafrsr\LibArray2Object\Parser\ValueParserInterface;
use Rafrsr\LibArray2Object\PropertyMatcher\CamelizeMatcher;
use Rafrsr\LibArray2Object\PropertyMatcher\PropertyMatcherInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Using the property names and the common property annotations
 * populate a object instance with the values of the array recursively
 */
class Array2Object
{
    /**
     * @var array|ValueParserInterface
     */
    private static $parsers = [];

    /**
     * @var PropertyMatcherInterface
     */
    private static $propertyMatcher;

    /**
     * registerParser
     *
     * @param ValueParserInterface|array $parsers
     */
    static public function registerParser($parsers)
    {
        if (is_array($parsers)) {
            foreach ($parsers as $parser) {
                self::$parsers[] = $parser;
            }
        } else {
            self::$parsers[] = $parsers;
        }
    }

    /**
     * @param PropertyMatcherInterface $propertyMatcher
     *
     * @return $this
     */
    public static function setPropertyMatcher(PropertyMatcherInterface $propertyMatcher)
    {
        self::$propertyMatcher = $propertyMatcher;
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
    static public function createObject($class, array $data)
    {
        if (is_string($class) && class_exists($class)) {
            $object = new $class;
        } else {
            throw new \InvalidArgumentException('The first argument should be a valid class, can use ::populate with objects');
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
        self::setup();//register parsers

        if (!is_object($object)) {
            throw new \InvalidArgumentException('The first param should be a object.');
        }

        $propertyAccessor = new PropertyAccessor();

        $reflClass = new \ReflectionClass($object);

        foreach (self::getClassProperties($reflClass) as $property) {
            foreach ($data as $key => $value) {
                if ($propertyAccessor->isWritable($object, $property->getName()) && self::$propertyMatcher->match($property, $key)) {
                    $types = self::getPropertyTypes($property);
                    $value = self::parseValue($value, $types, $property, $object);
                    $propertyAccessor->setValue($object, $property->getName(), $value);
                }
            }
        }
    }

    /**
     * setup
     */
    static private function setup()
    {
        if (!self::$propertyMatcher) {
            self::$propertyMatcher = new CamelizeMatcher();
        }

        self::registerParser(
            [
                new StringParser(),
                new BooleanParser(),
                new IntegerParser(),
                new FloatParser(),
                new DateTimeParser(),
                new ObjectParser()
            ]
        );
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
     * Parse a value using given types
     *
     * @param mixed               $value
     * @param array               $types
     * @param \ReflectionProperty $property
     * @param object              $object
     *
     * @return array|bool|float|int|string
     */
    static private function parseValue($value, $types, \ReflectionProperty $property, $object)
    {
        foreach ($types as $type) {

            foreach (self::$parsers as $parser) {
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