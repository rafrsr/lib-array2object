<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Naming;

class CallableNamingStrategy implements NamingStrategyInterface
{
    /**
     * @var callable
     */
    protected $parserCallback;

    /**
     * CallableParser constructor.
     *
     * @param callable $parserCallback
     */
    public function __construct(callable $parserCallback)
    {
        $this->parserCallback = $parserCallback;
    }

    /**
     * @inheritDoc
     */
    public function transformName($name)
    {
        return call_user_func($this->parserCallback, $name);
    }
}