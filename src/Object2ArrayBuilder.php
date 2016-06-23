<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object;

use Rafrsr\LibArray2Object\Naming\CallableNamingStrategy;
use Rafrsr\LibArray2Object\Naming\CamelCaseNamingStrategy;
use Rafrsr\LibArray2Object\Naming\IdenticalNamingStrategy;
use Rafrsr\LibArray2Object\Naming\UnderscoreNamingStrategy;
use Rafrsr\LibArray2Object\Reader\AccessorReader;
use Rafrsr\LibArray2Object\Reader\PropertyReaderInterface;
use Rafrsr\LibArray2Object\Reader\ReflectionReader;
use Rafrsr\LibArray2Object\Traits\IgnoreNullsTrait;
use Rafrsr\LibArray2Object\Traits\NamingStrategyAwareTrait;

class Object2ArrayBuilder extends AbstractBuilder
{
    use NamingStrategyAwareTrait;
    use IgnoreNullsTrait;

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
     * Name array keys as "PropertyName"
     *
     * @return $this
     */
    public function useUcFirstCamelCaseNamingStrategy()
    {
        $this->setNamingStrategy(new CamelCaseNamingStrategy(true));

        return $this;
    }

    /**
     * Name array keys as "propertyName"
     *
     * @return $this
     */
    public function useCamelCaseNamingStrategy()
    {
        $this->setNamingStrategy(new CamelCaseNamingStrategy());

        return $this;
    }

    /**
     * Name array keys as "property_name"
     *
     * @return $this
     */
    public function useUnderScoreNamingStrategy()
    {
        $this->setNamingStrategy(new UnderscoreNamingStrategy());

        return $this;
    }

    /**
     * The array keys is identical to property name
     *
     * @return $this
     */
    public function useIdenticalNamingStrategy()
    {
        $this->setNamingStrategy(new IdenticalNamingStrategy());

        return $this;
    }

    /**
     * Use given callback to transform the array key
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function useCallbackNamingStrategy(callable  $callback)
    {
        $this->setNamingStrategy(new CallableNamingStrategy($callback));

        return $this;
    }

    /**
     * Read the property directly without use getters
     *
     * @param boolean $onlyPublicProperties only public properties should be exported
     *
     * @return $this
     */
    public function disableGetters($onlyPublicProperties = false)
    {
        $this->setReader(new ReflectionReader($onlyPublicProperties));

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
            $context->setIgnoreNulls($this->isIgnoreNulls());
            $context->setReader($this->getReader() ?: new AccessorReader());
            $context->setNamingStrategy($this->getNamingStrategy() ?: new CamelCaseNamingStrategy());
        }
    }
}