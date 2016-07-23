<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Matcher;

/**
 * Class MapMatcher.
 */
class MapMatcher implements PropertyMatcherInterface
{
    /**
     * @var array
     */
    protected $map;

    /**
     * MapMatcher constructor.
     *
     * @param array $map
     */
    public function __construct(array $map)
    {
        $this->map = $map;
    }

    /**
     * {@inheritdoc}
     */
    public function match(\ReflectionProperty $property, $givenName)
    {
        if (array_key_exists($property->getName(), $this->map)) {
            return $this->map[$property->getName()] === $givenName;
        }

        return false;
    }
}
