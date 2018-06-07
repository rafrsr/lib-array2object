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

use Rafrsr\LibArray2Object\Parser\ValueParserInterface;

class Object2Array
{
    /**
     * @var Object2ArrayContext
     */
    private $context;

    /**
     * @param Object2ArrayContext $context
     */
    public function __construct(Object2ArrayContext $context)
    {
        $this->context = $context;
    }

    /**
     * @return Object2ArrayContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param Object2ArrayContext $context
     *
     * @return $this
     */
    public function setContext(Object2ArrayContext $context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @param object $object object instance to traverse
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    public function createArray($object)
    {
        if (!is_object($object)) {
            throw new \InvalidArgumentException('The first param should be a object.');
        }

        $array = [];
        if ($object instanceof Object2ArrayInterface) {
            $array = $object->__toArray();
            array_walk_recursive(
                $array,
                function (&$item) {
                    if (is_object($item)) {
                        $item = $this->createArray($item);
                    }
                }
            );
        } else {
            foreach (Utils::getClassProperties(get_class($object)) as $property) {
                if ($this->context->getReader()->isReadable($object, $property->getName())) {
                    $value = $this->context->getReader()->getValue($object, $property->getName());
                    $types = $types = Utils::getPropertyTypes($property);
                    $value = $this->parseValue($value, $types, $property, $object);

                    if ($value === null && $this->context->isIgnoreNulls()) {
                        continue;
                    }

                    $transformedName = $this->context->getNamingStrategy()->transformName($property->getName());
                    $array[$transformedName] = $value;
                }
            }
        }

        return $array;
    }

    /**
     * Parse a value using given types.
     *
     * @param mixed               $value
     * @param array               $types
     * @param \ReflectionProperty $property
     * @param object              $object
     *
     * @return array|bool|float|int|string
     */
    private function parseValue($value, $types, \ReflectionProperty $property, $object)
    {
        foreach ($types as $type) {
            foreach ($this->context->getParsers() as $parser) {
                if ($parser instanceof ValueParserInterface) {
                    if (is_array($value) && strpos($type, '[]') !== false) {
                        foreach ($value as $key => &$arrayValue) {
                            $arrayValue = $parser->toArrayValue($arrayValue, str_replace('[]', null, $type), $property, $arrayValue);
                        }
                    } else {
                        $value = $parser->toArrayValue($value, $type, $property, $object);
                    }
                } else {
                    throw new \InvalidArgumentException(sprintf('%s is not a valid parser.', get_class($parser)));
                }
            }
        }

        return $value;
    }
}
