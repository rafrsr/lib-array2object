<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object;

use Rafrsr\LibArray2Object\Matcher\CallableMatcher;
use Rafrsr\LibArray2Object\Matcher\CamelizeMatcher;
use Rafrsr\LibArray2Object\Matcher\IdenticalMatcher;
use Rafrsr\LibArray2Object\Matcher\LevenshteinMatcher;
use Rafrsr\LibArray2Object\Matcher\MapMatcher;
use Rafrsr\LibArray2Object\Traits\MatcherAwareTrait;
use Rafrsr\LibArray2Object\Writer\AccessorWriter;
use Rafrsr\LibArray2Object\Writer\PropertyWriterInterface;
use Rafrsr\LibArray2Object\Writer\ReflectionWriter;

/**
 * Class Array2ObjectBuilder.
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
     * Array keys and property names are identical.
     *
     * @return $this
     */
    public function useIdenticalMatcher()
    {
        $this->setMatcher(new IdenticalMatcher());

        return $this;
    }

    /**
     * Array keys and property names are compared using some property possible versions
     * e.g, propertyName => property_name.
     *
     * @return $this
     */
    public function useCamelizeMatcher()
    {
        $this->setMatcher(new CamelizeMatcher());

        return $this;
    }

    /**
     * Array keys and property names are compared using levenshtein algorithm to find similar strings.
     *
     * @return $this
     */
    public function useLevenshteinMatcher()
    {
        $this->setMatcher(new LevenshteinMatcher());

        return $this;
    }

    /**
     * Array keys and property names are compared using the given property and array key map.
     *
     * @param array $map
     *
     * @return $this
     */
    public function useMapMatcher(array $map)
    {
        $this->setMatcher(new MapMatcher($map));

        return $this;
    }

    /**
     * Array keys and property names are compared using custom function
     * the given function receive two parameters \ReflectionProperty $property, $givenName.
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function useCallableMatcher(callable $callback)
    {
        $this->setMatcher(new CallableMatcher($callback));

        return $this;
    }

    /**
     * Write the property directly without use setters.
     *
     * @param bool $onlyPublicProperties only public properties should be exported
     *
     * @return $this
     */
    public function disableSetters($onlyPublicProperties = false)
    {
        $this->setWriter(new ReflectionWriter($onlyPublicProperties));

        return $this;
    }

    /**
     * Build custom Array2Object instance.
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
     * {@inheritdoc}
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
