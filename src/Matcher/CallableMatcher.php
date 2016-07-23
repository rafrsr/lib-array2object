<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Matcher;

class CallableMatcher implements PropertyMatcherInterface
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
    public function match(\ReflectionProperty $property, $givenName)
    {
        return call_user_func($this->parserCallback, $property, $givenName);
    }
}
