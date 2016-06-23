<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Traits;

use Rafrsr\LibArray2Object\Parser;
use Rafrsr\LibArray2Object\Parser\ValueParserInterface;

Trait ParsersAwareTrait
{
    /**
     * @var array|ValueParserInterface[]
     */
    private $parsers = [];

    /**
     * @return array|Parser\ValueParserInterface[]
     */
    public function getParsers()
    {
        return $this->parsers;
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
     * Append parser to the list of parsers, LOW priority
     *
     * @param ValueParserInterface $parser
     *
     * @return $this
     */
    public function appendParser(ValueParserInterface $parser)
    {
        $this->parsers[$parser->getName()] = $parser;

        return $this;
    }

    /**
     * Prepend parser to list of parsers, HIGH priority
     *
     * @param ValueParserInterface $parser
     *
     * @return $this
     */
    public function prependParser(ValueParserInterface $parser)
    {
        $parsers = $this->parsers;
        if (array_key_exists($parser->getName(), $parsers)) {
            unset($parsers[$parser->getName()]);
        }

        $this->parsers = array_merge([$parser->getName() => $parser], $parsers);

        return $this;
    }
}