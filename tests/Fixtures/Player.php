<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */
namespace Rafrsr\LibArray2Object\Tests\Fixtures;

/**
 * Class Player.
 */
class Player
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $number;

    /**
     * @var float
     */
    protected $height;

    /**
     * @var bool
     */
    protected $regular;

    /**
     * Player constructor.
     *
     * @param string $name
     * @param int    $number
     */
    public function __construct($name = null, $number = null)
    {
        $this->name = $name;
        $this->number = $number;
    }

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
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float $height
     *
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRegular()
    {
        return $this->regular;
    }

    /**
     * @param bool $regular
     *
     * @return $this
     */
    public function setRegular($regular)
    {
        $this->regular = $regular;

        return $this;
    }
}
