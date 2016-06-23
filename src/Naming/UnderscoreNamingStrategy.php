<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Naming;

use Doctrine\Common\Inflector\Inflector;

/**
 * Transform property name from "propertyName" -> "property_name"
 */
class UnderscoreNamingStrategy implements NamingStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function transformName($name)
    {
        return Inflector::tableize($name);
    }
}