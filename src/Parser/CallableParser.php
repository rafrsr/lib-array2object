<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
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
