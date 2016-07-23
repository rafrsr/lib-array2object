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

use Rafrsr\LibArray2Object\Parser\StringParser;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;

class StringParserTest extends ParserTester
{
    public function buildParser()
    {
        return new StringParser();
    }

    public function getTypes()
    {
        return ['string'];
    }

    public function getParseValueMap()
    {
        return [
            'string' => 'string',
            'Team Name' => new Team('Team Name'),
        ];
    }
}
