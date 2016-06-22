<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Parser;

use Rafrsr\LibArray2Object\Array2Object;

class ObjectParser implements ValueParserInterface
{
    /**
     * @inheritDoc
     */
    public function parseValue($value, $type, \ReflectionProperty $property, $object)
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
            return Array2Object::createObject($className, $value);
        }

        return $value;
    }
}