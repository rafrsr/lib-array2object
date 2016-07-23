<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Tests\Parser;

use Rafrsr\LibArray2Object\Parser\FloatParser;

class FloatParserTest extends ParserTester
{
    public function buildParser()
    {
        return new FloatParser();
    }

    public function getTypes()
    {
        return ['float', 'double'];
    }

    public function getParseValueMap()
    {
        return [
            '1' => 1,
            '12 apples' => 12,
            '12.2' => 12.2,
        ];
    }
}
