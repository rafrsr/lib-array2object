<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object;

use Rafrsr\LibArray2Object\Matcher\CamelizeMatcher;
use Rafrsr\LibArray2Object\Parser\BooleanParser;
use Rafrsr\LibArray2Object\Parser\DateTimeParser;
use Rafrsr\LibArray2Object\Parser\FloatParser;
use Rafrsr\LibArray2Object\Parser\IntegerParser;
use Rafrsr\LibArray2Object\Parser\ObjectParser;
use Rafrsr\LibArray2Object\Parser\StringParser;
use Rafrsr\LibArray2Object\Parser\ValueParserInterface;
use Rafrsr\LibArray2Object\Matcher\PropertyMatcherInterface;
use Rafrsr\LibArray2Object\Writer\AccessorWriter;
use Rafrsr\LibArray2Object\Writer\PropertyWriterInterface;

/**
 * Class Array2ObjectBuilder
 */
class Array2ObjectBuilder
{

    /**
     * @var Array2ObjectContext
     */
    private $context;

    /**
     * @var array|ValueParserInterface[]
     */
    private $parsers = [];

    /**
     * @var PropertyMatcherInterface
     */
    private $propertyMatcher;

    /**
     * @var PropertyWriterInterface
     */
    private $propertyWriter;

    /**
     * @var array
     */
    private $disabledParsers = [];

    /**
     * create builder instance
     *
     * @return static
     */
    public static function create()
    {
        return new static;
    }

    /**
     * @return Array2ObjectContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param Array2ObjectContext $context
     *
     * @return $this
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @return array|Parser\ValueParserInterface[]
     */
    public function getParsers()
    {
        return $this->parsers;
    }

    /**
     * @param ValueParserInterface $parser
     *
     * @return $this
     */
    public function addParser(ValueParserInterface $parser)
    {
        $this->parsers[$parser->getName()] = $parser;

        return $this;
    }

    /**
     * @param string|ValueParserInterface $parser
     *
     * @return boolean
     */
    public function hasParser($parser)
    {
        if ($parser instanceof ValueParserInterface) {
            $parser = $parser->getName();
        }

        return array_key_exists($parser, $this->parsers);
    }

    /**
     * disableParser
     *
     * @param string|ValueParserInterface $parser
     *
     * @return $this
     */
    public function disableParser($parser)
    {
        if ($parser instanceof ValueParserInterface) {
            $parser = $parser->getName();
        }

        if (is_string($parser)) {
            $this->disabledParsers[] = $parser;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getDisabledParsers()
    {
        return $this->disabledParsers;
    }

    /**
     * @param string|ValueParserInterface $parser
     *
     * @return $this
     */
    public function removeParser($parser)
    {
        if ($parser instanceof ValueParserInterface) {
            $parser = $parser->getName();
        }

        if (is_string($parser) && $this->hasParser($parser)) {
            unset($this->parsers[$parser]);
        }

        return $this;
    }

    /**
     * @param array|Parser\ValueParserInterface[] $parsers
     *
     * @return $this
     */
    public function setParsers($parsers)
    {
        $this->parsers = [];
        foreach ($parsers as $parser) {
            if ($parser instanceof ValueParserInterface) {
                $this->parsers[$parser->getName()] = $parser;
            }
        }

        return $this;
    }

    /**
     * @return PropertyMatcherInterface
     */
    public function getPropertyMatcher()
    {
        return $this->propertyMatcher;
    }

    /**
     * @param PropertyMatcherInterface $propertyMatcher
     *
     * @return $this
     */
    public function setPropertyMatcher(PropertyMatcherInterface $propertyMatcher)
    {
        $this->propertyMatcher = $propertyMatcher;

        return $this;
    }

    /**
     * @return PropertyWriterInterface
     */
    public function getPropertyWriter()
    {
        return $this->propertyWriter;
    }

    /**
     * @param PropertyWriterInterface $propertyWriter
     *
     * @return $this
     */
    public function setPropertyWriter($propertyWriter)
    {
        $this->propertyWriter = $propertyWriter;

        return $this;
    }

    /**
     * Build custom Array2Object instance
     */
    public function build()
    {
        if ($this->getContext()) {
            $context = $this->getContext();
        } else {
            $context = new Array2ObjectContext();
        }

        //defaults
        $context->setMatcher($this->getPropertyMatcher() ?: new CamelizeMatcher());
        $context->setWriter($this->getPropertyWriter() ?: new AccessorWriter());
        $context->setParsers(
            [
                new StringParser(),
                new BooleanParser(),
                new IntegerParser(),
                new FloatParser(),
                new DateTimeParser(),
                new ObjectParser($context)
            ]
        );

        //add custom parsers
        foreach ($this->parsers as $parser) {
            if ($parser instanceof ValueParserInterface) {
                $context->prependParser($parser);
            }
        }

        //disable parsers
        foreach ($this->disabledParsers as $disabledParser) {
            $actualParsers = $context->getParsers();
            if (array_key_exists($disabledParser, $actualParsers)) {
                unset($actualParsers[$disabledParser]);
            }
            $context->setParsers($actualParsers);
        }

        return new Array2Object($context);
    }
}