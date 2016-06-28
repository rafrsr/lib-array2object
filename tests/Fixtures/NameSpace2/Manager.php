<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\Fixtures\NameSpace2;

/**
 * Class Manager
 */
class Manager
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $salary;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return float
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param float $salary
     *
     * @return $this
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }
}