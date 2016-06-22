<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object;

use Rafrsr\LibArray2Object\Matcher\CamelizeMatcher;
use Rafrsr\LibArray2Object\Writer\AccessorWriter;
use Rafrsr\LibArray2Object\Writer\PropertyWriterInterface;

/**
 * Class Array2ObjectBuilder
 */
class Array2ObjectBuilder extends AbstractBuilder
{
    use MatcherAwareTrait;

    /**
     * @var PropertyWriterInterface
     */
    private $writer;

    /**
     * @return PropertyWriterInterface
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * @param PropertyWriterInterface $writer
     *
     * @return $this
     */
    public function setWriter($writer)
    {
        $this->writer = $writer;

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

        $this->prepareContext($context);

        return new Array2Object($context);
    }

    /**
     * @inheritDoc
     */
    protected function prepareContext(AbstractContext $context)
    {
        parent::prepareContext($context);

        if ($context instanceof Array2ObjectContext) {
            $context->setWriter($this->getWriter() ?: new AccessorWriter());
            $context->setMatcher($this->getMatcher() ?: new CamelizeMatcher());
        }
    }
}