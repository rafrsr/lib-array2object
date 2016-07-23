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

use Rafrsr\LibArray2Object\Parser\IntegerParser;

class IntegerParserTest extends ParserTester
{
    public function buildParser()
    {
        return new IntegerParser();
    }

    public function getTypes()
    {
        return ['integer', 'int'];
    }

    public function getParseValueMap()
    {
        return [
            '1' => 1,
            '12 apples' => 12,
            '12.2' => 12,
        ];
    }
}
