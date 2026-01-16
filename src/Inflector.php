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

use Doctrine\Inflector\InflectorFactory;

/**
 * Class Inflector
 */
class Inflector
{
    /**
     * Convert word in to the format for a Doctrine table name. Converts 'ModelName' to 'model_name'
     *
     * @param string $word Word to tableize
     *
     * @return string $word  Tableized word
     */
    public static function tableize(string $word): string
    {
        return InflectorFactory::create()->build()->tableize($word);
    }

    /**
     * Convert a word in to the format for a Doctrine class name. Converts 'table_name' to 'TableName'
     *
     * @param string $word Word to classify
     *
     * @return string $word  Classified word
     */
    public static function classify(string $word): string
    {
        return InflectorFactory::create()->build()->classify($word);
    }

    /**
     * Camelize a word. This uses the classify() method and turns the first character to lowercase
     *
     * @param string $word
     *
     * @return string $word
     */
    public static function camelize(string $word): string
    {
        return InflectorFactory::create()->build()->camelize($word);
    }

    /**
     * Return $word in plural form.
     *
     * @param string $word Word in singular
     *
     * @return string Word in plural
     */
    public static function pluralize(string $word): string
    {
        return InflectorFactory::create()->build()->pluralize($word);
    }

    /**
     * Return $word in singular form.
     *
     * @param string $word Word in plural
     *
     * @return string Word in singular
     */
    public static function singularize(string $word): string
    {

        return InflectorFactory::create()->build()->singularize($word);
    }
}