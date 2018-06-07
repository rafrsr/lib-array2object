<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object;

use Rafrsr\LibArray2Object\Parser\ValueParserInterface;

/**
 * Using the property names and the common property annotations
 * populate a object instance with the values of the array recursively.
 */
class Array2Object
{
    /**
     * @var Array2ObjectContext
     */
    private $context;

    /**
     * @var array
     */
    private static $classProperties = [];

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
     * createObject.
     *
     * @param string $class class to create object or instance
     * @param array  $data  array of data
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    public function createObject($class, array $data)
    {
        if (is_string($class) && class_exists($class)) {
            $object = new $class();
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
            //this static cache is helpful when populate
            //many objects of the same type in a loop
            static $matcherCache = [];
            static $writerCache = [];

            $objectClass = get_class($object);
            $properties = Utils::getClassProperties($objectClass);
            foreach ($properties as $property) {
                //save in cache if the property is writable
                $writableCacheHash = $objectClass.$property->getName();
                if (!isset($writerCache[$writableCacheHash])) {
                    $writerCache[$writableCacheHash] = $this->context->getWriter()->isWritable($object, $property->getName());
                }
                foreach ($data as $key => $value) {
                    //save in cache if the property name match with key
                    $propHash = $objectClass.$property->getName().$key;
                    if (!isset($matcherCache[$propHash])) {
                        $matcherCache[$propHash] = $this->context->getMatcher()->match($property, $key);
                    }

                    if ($writerCache[$writableCacheHash] && $matcherCache[$propHash]) {
                        $types = Utils::getPropertyTypes($property);
                        $value = $this->parseValue($value, $types, $property, $object);
                        $this->context->getWriter()->setValue($object, $property->getName(), $value);
                    }
                }
            }
        }
    }

    /**
     * Parse a value using given types.
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
                        if (count($value) === 1 && is_array(current($value))) {
                            if (array_key_exists(0, current($value))) {
                                $value = current($value);
                            }
                        }

                        $tmpArray = [];
                        foreach ($value as $key => $arrayValue) {
                            $parsedValue = $parser->toObjectValue($arrayValue, str_replace('[]', null, $type), $property, $object);
                            //the annotation [] is used alone to ignore array keys
                            if (in_array('[]', $types, true)) {
                                $tmpArray[] = $parsedValue;
                            } else {
                                $tmpArray[$key] = $parsedValue;
                            }
                        }
                        $value = $tmpArray;
                    } else {
                        $value = $parser->toObjectValue($value, str_replace('[]', null, $type), $property, $object);
                    }
                } else {
                    throw new \InvalidArgumentException(sprintf('%s is not a valid parser.', get_class($parser)));
                }
            }
        }

        return $value;
    }
}
