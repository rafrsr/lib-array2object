<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Parser;

use Rafrsr\LibArray2Object\AbstractContext;
use Rafrsr\LibArray2Object\Array2Object;
use Rafrsr\LibArray2Object\Array2ObjectContext;
use Rafrsr\LibArray2Object\Object2Array;
use Rafrsr\LibArray2Object\Object2ArrayContext;

class ObjectParser implements ValueParserInterface
{
    const NAME = 'object';

    /** @var Array2Object */
    protected $array2Object;
    /** @var Object2Array */
    protected $object2Array;

    /**
     * ObjectParser constructor.
     *
     * @param AbstractContext $context
     */
    public function __construct(AbstractContext $context)
    {
        if ($context instanceof Array2ObjectContext) {
            $this->array2Object = new Array2Object($context);
        } elseif ($context instanceof Object2ArrayContext) {
            $this->object2Array = new Object2Array($context);
        }
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * @inheritDoc
     */
    public function toObjectValue($value, $type, \ReflectionProperty $property, $object)
    {
        $className = null;
        $context = new \ReflectionClass($property->class);

        //use the type as class
        if (class_exists($type)) {
            $className = $type;
        }

        //try to get the class from use statements in the class file
        if ($className === null) {
            $classContent = file_get_contents($context->getFileName());

            $regExps = [
                "/use\s+([\w\\\]+$type);/", //use NameSpace\ClassName;
                "/use\s+([\w\\\]+)\s+as\s+$type/"//use NameSpace\ClassName as ClassAlias;
            ];
            foreach ($regExps as $regExp) {
                if ($matchClass = $this->extractClass($regExp, $classContent)) {
                    $className = $matchClass;
                    break;
                }
            }
        }

        //use the same namespace as class container
        if ($className === null && class_exists($context->getNamespaceName() . "\\" . $type)) {
            $className = $context->getNamespaceName() . "\\" . $type;
        }

        if (is_array($value) && $className !== null && class_exists($className) && $this->array2Object) {
            return $this->array2Object->createObject($className, $value);
        }

        return $value;
    }

    /**
     * @inheritDoc
     */
    public function toArrayValue($value, $type, \ReflectionProperty $property, $object)
    {
        if (is_object($value)) {
            return $this->object2Array->createArray($value);
        }

        return $value;
    }

    /**
     * Extract class usage from origin class content using regular expresion
     *
     * @param $regEx
     * @param $classContent
     *
     * @return null
     */
    private function extractClass($regEx, $classContent)
    {
        preg_match($regEx, $classContent, $matches);
        if (isset($matches[1]) && class_exists($matches[1])) {
            return $matches[1];
        }

        return null;
    }
}