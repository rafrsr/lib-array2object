<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Parser;

/**
 * Class CallableParser.
 */
class CallableParser implements ValueParserInterface
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
    public function getName()
    {
        //unique name for each callback
        return spl_object_hash($this->parserCallback);
    }

    /**
     * {@inheritdoc}
     */
    public function toObjectValue($value, $type, \ReflectionProperty $property, $object)
    {
        return call_user_func($this->parserCallback, $value, $type, $property, $object);
    }

    /**
     * {@inheritdoc}
     */
    public function toArrayValue($value, $type, \ReflectionProperty $property, $object)
    {
        return call_user_func($this->parserCallback, $value, $type, $property, $object);
    }
}
