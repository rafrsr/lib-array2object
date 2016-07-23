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
