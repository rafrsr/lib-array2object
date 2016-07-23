<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object;

use Rafrsr\LibArray2Object\Parser\ArrayParser;
use Rafrsr\LibArray2Object\Parser\BooleanParser;
use Rafrsr\LibArray2Object\Parser\DateTimeParser;
use Rafrsr\LibArray2Object\Parser\FloatParser;
use Rafrsr\LibArray2Object\Parser\IntegerParser;
use Rafrsr\LibArray2Object\Parser\ObjectParser;
use Rafrsr\LibArray2Object\Parser\StringParser;
use Rafrsr\LibArray2Object\Parser\ValueParserInterface;
use Rafrsr\LibArray2Object\Traits\ParsersAwareTrait;

abstract class AbstractBuilder
{
    use ParsersAwareTrait;

    /**
     * @var AbstractContext
     */
    private $context;

    /**
     * @var array
     */
    private $disabledParsers = [];

    /**
     * create builder instance.
     *
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * @return AbstractContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param AbstractContext $context
     *
     * @return $this
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
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
     * @return bool
     */
    public function hasParser($parser)
    {
        if ($parser instanceof ValueParserInterface) {
            $parser = $parser->getName();
        }

        return array_key_exists($parser, $this->parsers);
    }

    /**
     * disableParser.
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
     * @param AbstractContext $context
     */
    protected function prepareContext(AbstractContext $context)
    {
        //defaults
        $context->setParsers(
            [
                new StringParser(),
                new BooleanParser(),
                new IntegerParser(),
                new FloatParser(),
                new DateTimeParser(),
                new ArrayParser(),
                new ObjectParser($context),
            ]
        );

        //add custom parsers
        foreach ($this->getParsers() as $parser) {
            if ($parser instanceof ValueParserInterface) {
                $context->prependParser($parser);
            }
        }

        //disable parsers
        foreach ($this->getDisabledParsers() as $disabledParser) {
            $actualParsers = $context->getParsers();
            if (array_key_exists($disabledParser, $actualParsers)) {
                unset($actualParsers[$disabledParser]);
            }
            $context->setParsers($actualParsers);
        }
    }

    abstract public function build();
}
