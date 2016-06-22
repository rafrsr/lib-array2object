<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Parser;

class DateTimeParser implements ValueParserInterface
{
    const NAME = 'datetime';

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * @inheritDoc
     */
    public function parseValue($value, $type, \ReflectionProperty $property, $object)
    {
        if (is_string($value) && ($type === 'DateTime' || $type === '\DateTime')) {
            return new \DateTime($value);
        }

        return $value;
    }
}