<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Matcher;

class CamelizeMatcher implements PropertyMatcherInterface
{
    /**
     * @inheritDoc
     */
    public function match(\ReflectionProperty $property, $givenName)
    {
        $propertyName = $property->getName();
        if ($propertyName === $givenName
            || $propertyName === $this->camelize($givenName) //ErrorCode = error_code
            || $propertyName === lcfirst($this->camelize($givenName)) // errorCode => error_code
            || $propertyName === strtolower($this->camelize($givenName)) // errorcode => error_code
            || strtolower($propertyName) === strtolower($givenName) // errorCode => ErroRCODe
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param $name
     *
     * @return string
     */
    private function camelize($name)
    {
        return strtr(ucwords(strtr($name, ['_' => ' '])), [' ' => '']);
    }
}