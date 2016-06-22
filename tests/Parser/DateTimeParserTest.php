<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\Parser;

use Rafrsr\LibArray2Object\Parser\DateTimeParser;

class DateTimeParserTest extends ParserTester
{
    public function buildParser()
    {
        return new DateTimeParser();
    }

    public function getTypes()
    {
        return ['\DateTime', 'DateTime'];
    }

    public function getParseValueMap()
    {
        return [
            '2016-01-01' => new \DateTime('2016-01-01'),
            'yesterday' => new \DateTime('yesterday'),
        ];
    }
}
