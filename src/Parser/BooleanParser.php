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

class BooleanParser implements ValueParserInterface
{
    const NAME = 'boolean';

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
                        $value = (boolean) $value;
                }
            } else {
                $value = (boolean) $value;
            }
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
