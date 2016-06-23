<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object;

use Rafrsr\LibArray2Object\Naming\CamelCaseNamingStrategy;
use Rafrsr\LibArray2Object\Reader\AccessorReader;
use Rafrsr\LibArray2Object\Reader\PropertyReaderInterface;
use Rafrsr\LibArray2Object\Traits\NamingStrategyAwareTrait;

class Object2ArrayBuilder extends AbstractBuilder
{
    use NamingStrategyAwareTrait;

    /**
     * @var PropertyReaderInterface
     */
    private $reader;

    /**
     * @return PropertyReaderInterface
     */
    public function getReader()
    {
        return $this->reader;
    }

    /**
     * @param PropertyReaderInterface $reader
     *
     * @return $this
     */
    public function setReader($reader)
    {
        $this->reader = $reader;

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
            $context = new Object2ArrayContext();
        }

        $this->prepareContext($context);

        return new Object2Array($context);
    }

    /**
     * @inheritDoc
     */
    protected function prepareContext(AbstractContext $context)
    {
        parent::prepareContext($context);

        if ($context instanceof Object2ArrayContext) {
            $context->setReader($this->getReader() ?: new AccessorReader());
            $context->setNamingStrategy($this->getNamingStrategy() ?:new CamelCaseNamingStrategy());
        }
    }
}