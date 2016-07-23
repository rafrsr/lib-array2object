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

class DateTimeParser implements ValueParserInterface
{
    const NAME = 'datetime';

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
        if (is_string($value) && ($type === 'DateTime' || $type === '\DateTime')) {
            return new \DateTime($value);
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function toArrayValue($value, $type, \ReflectionProperty $property, $object)
    {
        if ($value instanceof \DateTime) {
            return $value->format('Y-m-d H:i:s');
        }

        return $value;
    }
}
