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

class CamelizeMatcher implements PropertyMatcherInterface
{
    /**
     * {@inheritdoc}
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
