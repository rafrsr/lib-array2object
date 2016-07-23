<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Tests\Fixtures\NameSpace2;

/**
 * Class Manager.
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
