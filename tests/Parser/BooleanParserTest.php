<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\Parser;

use Rafrsr\LibArray2Object\Parser\BooleanParser;

class BooleanParserTest extends ParserTester
{
    public function buildParser()
    {
        return new BooleanParser();
    }

    public function getTypes()
    {
        return ['boolean', 'bool'];
    }

    public function getParseValueMap()
    {
        return [
            'yes' => true,
            'YES' => true,
            'ok' => true,
            'true' => true,
            'some_string' => true,
            1 => true,
            -1 => true,
            'no' => false,
            'false' => false,
            'FALSE' => false,
            0 => false,
        ];
    }
}
