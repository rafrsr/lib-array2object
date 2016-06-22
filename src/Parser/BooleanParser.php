<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Parser;

class BooleanParser implements ValueParserInterface
{
    /**
     * @inheritDoc
     */
    public function parseValue($value, $type, \ReflectionProperty $property, $object)
    {
        if ($type === 'boolean' || $type === 'bool') {
            if (is_string($value)) {
                switch (strtolower($value)) {
                    case 'true':
                    case 'yes':
                    case 'ok':
                        $value = true;
                        break;
                    case 'false':
                    case 'no':
                        $value = false;
                        break;
                    default:
                        $value = (boolean)$value;
                }
            } else {
                $value = (boolean)$value;
            }
        }

        return $value;
    }
}