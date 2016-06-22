<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Parser;

class IntegerParser implements ValueParserInterface
{
    const NAME = 'integer';

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
        if ($type === 'integer' || $type === 'int') {
            return (integer)$value;
        }

        return $value;
    }
}