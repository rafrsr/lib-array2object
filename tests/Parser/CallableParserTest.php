<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Tests\Parser;

use Rafrsr\LibArray2Object\Parser\CallableParser;

class CallableParserTest extends ParserTester
{
    public function buildParser()
    {
        return new CallableParser(
            function ($value, $type, \ReflectionProperty $property, $object) {
                return ($value === 'success') ? true : false;
            }
        );
    }

    public function getTypes()
    {
        return ['\DateTime', 'DateTime'];
    }

    public function getParseValueMap()
    {
        return [
            'success' => true,
            'fail' => false,
        ];
    }
}
