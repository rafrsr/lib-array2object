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

/**
 * Class Utils.
 */
class Utils
{
    private static $classPropertyes = [];

    private static $propertyTypes = [];

    /**
     * Get array of class properties including parents private properties.
     *
     * @param \ReflectionClass|string $class
     *
     * @return array|\ReflectionProperty[]
     *
     * @throws \ReflectionException
     * @throws \InvalidArgumentException
     */
    public static function getClassProperties($class)
    {
        if (is_string($class)) {
            if (isset(self::$classPropertyes[$class])) {
                return self::$classPropertyes[$class];
            }

            $class = new \ReflectionClass($class);
        }

        if (!$class instanceof \ReflectionClass) {
            throw new \InvalidArgumentException('The arguments must be a valid class name or reflection');
        }

        if (isset(self::$classPropertyes[$class->getName()])) {
            return self::$classPropertyes[$class->getName()];
        }

        $props = $class->getProperties();
        $props_arr = [];
        foreach ($props as $prop) {
            $f = $prop->getName();

            $props_arr[$f] = $prop;
        }
        if ($parentClass = $class->getParentClass()) {
            $parent_props_arr = static::getClassProperties($parentClass);//RECURSION
            if (count($parent_props_arr) > 0) {
                $props_arr = array_merge($parent_props_arr, $props_arr);
            }
        }

        self::$classPropertyes[$class->getName()] = $props_arr;

        return $props_arr;
    }

    /**
     * @param \ReflectionProperty $property
     *
     * @return array
     */
    public static function getPropertyTypes(\ReflectionProperty $property)
    {
        $hash = $property->class.'-'.$property->getName();

        if (isset(self::$propertyTypes[$hash])) {
            return self::$propertyTypes[$hash];
        }

        $doc = $property->getDocComment();
        preg_match('/@var\s([\w\\\|\[\]]+)/', $doc, $matches);
        $types = [];
        if (isset($matches[1])) {
            $types = explode('|', $matches[1]);
        }

        self::$propertyTypes[$hash] = $types;

        return $types;
    }
}
