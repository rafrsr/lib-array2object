<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Parser;

/**
 * ValueParserInterface.
 */
interface ValueParserInterface
{
    /**
     * get parse name.
     *
     * @return string
     */
    public function getName();

    /**
     * @param mixed               $value    current value
     * @param string              $type     property annotation type
     * @param \ReflectionProperty $property current property
     * @param object              $object   object instance to use as context is needed
     *
     * @return mixed parsed value
     */
    public function toObjectValue($value, $type, \ReflectionProperty $property, $object);

    /**
     * @param mixed               $value    current value
     * @param string              $type     property annotation type
     * @param \ReflectionProperty $property current property
     * @param object              $object   object instance to use as context is needed
     *
     * @return mixed parsed value
     */
    public function toArrayValue($value, $type, \ReflectionProperty $property, $object);
}
