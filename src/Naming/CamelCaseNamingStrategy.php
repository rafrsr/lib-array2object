<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Naming;

use Doctrine\Common\Util\Inflector;

/**
 * Transform property name from "property_name" -> "propertyName"
 */
class CamelCaseNamingStrategy implements NamingStrategyInterface
{
    /**
     * @var bool
     */
    protected $ucFirst;

    /**
     * CamelCaseNamingStrategy constructor.
     *
     * @param boolean $ucFirst
     */
    public function __construct($ucFirst = false)
    {
        $this->ucFirst = $ucFirst;
    }

    /**
     * @inheritDoc
     */
    public function transformName($name)
    {
        if ($this->ucFirst) {
            return Inflector::classify($name);
        } else {
            return Inflector::camelize($name);
        }
    }
}