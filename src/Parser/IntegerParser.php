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

class IntegerParser implements ValueParserInterface
{
    const NAME = 'integer';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function toObjectValue($value, $type, \ReflectionProperty $property, $object)
    {
        if ($type === 'integer' || $type === 'int') {
            return (integer) $value;
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function toArrayValue($value, $type, \ReflectionProperty $property, $object)
    {
        return $value;
    }
}
