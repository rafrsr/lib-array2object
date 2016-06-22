<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
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
