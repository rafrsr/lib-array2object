<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Parser;

/**
 * ValueParserInterface
 */
interface ValueParserInterface
{
    /**
     * get parse name
     *
     * @return string
     */
    public function getName();

    /**
     * @param  mixed              $value    current value
     * @param  string             $type     property annotation type
     * @param \ReflectionProperty $property current property
     * @param object              $object   object instance to use as context is needed
     *
     * @return mixed parsed value
     */
    public function toObjectValue($value, $type, \ReflectionProperty $property, $object);

    /**
     * @param  mixed              $value    current value
     * @param  string             $type     property annotation type
     * @param \ReflectionProperty $property current property
     * @param object              $object   object instance to use as context is needed
     *
     * @return mixed parsed value
     */
    public function toArrayValue($value, $type, \ReflectionProperty $property, $object);
}