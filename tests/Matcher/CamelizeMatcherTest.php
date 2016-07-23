<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Tests\Matcher;

use Rafrsr\LibArray2Object\Matcher\CamelizeMatcher;

class CamelizeMatcherTest extends PropertyMatcherTester
{
    /**
     * {@inheritdoc}
     */
    public function buildMatcher()
    {
        return new CamelizeMatcher();
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function getNotEquals()
    {
        return [
            'test' => 'testing',
        ];
    }
}
