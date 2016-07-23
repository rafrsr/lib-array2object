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
