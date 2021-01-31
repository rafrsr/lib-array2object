<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Naming;

use Rafrsr\LibArray2Object\Inflector;

/**
 * Transform property name from "propertyName" -> "property_name".
 */
class UnderscoreNamingStrategy implements NamingStrategyInterface
{
    /**
     * {@inheritdoc}
     */
    public function transformName($name)
    {
        return Inflector::tableize($name);
    }
}
