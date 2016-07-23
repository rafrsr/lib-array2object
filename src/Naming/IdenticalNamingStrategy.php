<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Naming;

class IdenticalNamingStrategy implements NamingStrategyInterface
{
    /**
     * {@inheritdoc}
     */
    public function transformName($name)
    {
        return $name;
    }
}
