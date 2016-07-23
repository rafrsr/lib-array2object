<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
     * {@inheritdoc}
     */
    public function transformName($name)
    {
        return call_user_func($this->parserCallback, $name);
    }
}
