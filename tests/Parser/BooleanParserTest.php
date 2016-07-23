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
