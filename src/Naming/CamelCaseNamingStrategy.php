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

use Doctrine\Common\Util\Inflector;

/**
 * Transform property name from "property_name" -> "propertyName".
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
     * @param bool $ucFirst
     */
    public function __construct($ucFirst = false)
    {
        $this->ucFirst = $ucFirst;
    }

    /**
     * {@inheritdoc}
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
