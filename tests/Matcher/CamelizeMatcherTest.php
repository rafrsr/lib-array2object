<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\Matcher;

use Rafrsr\LibArray2Object\Matcher\CamelizeMatcher;

class CamelizeMatcherTester extends PropertyMatcherTester
{
    /**
     * @inheritDoc
     */
    public function buildMatcher()
    {
        return new CamelizeMatcher();
    }

    /**
     * @inheritDoc
     */
    public function getEquals()
    {
        return [
            'test' => 'test',
            'Test' => 'Test',
            'ErrorCode' => 'error_code',
            'errorCode' => 'error_code',
            'errorcode' => 'error_code',
            'errorCodes' => 'errorcodes',
        ];
    }

    /**
     * @inheritDoc
     */
    public function getNotEquals()
    {
        return [
            'test' => 'testing'
        ];
    }
}
