<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
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
