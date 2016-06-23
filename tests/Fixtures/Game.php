<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\Fixtures;

use Rafrsr\LibArray2Object\Array2Object;
use Rafrsr\LibArray2Object\Array2ObjectInterface;
use Rafrsr\LibArray2Object\Object2Array;
use Rafrsr\LibArray2Object\Object2ArrayInterface;

class Game implements Array2ObjectInterface, Object2ArrayInterface
{

    protected $stadiumName;

    protected $date;

    protected $homeClub;

    protected $visitor;

    /**
     * @return mixed
     */
    public function getStadiumName()
    {
        return $this->stadiumName;
    }

    /**
     * @param mixed $stadiumName
     *
     * @return $this
     */
    public function setStadiumName($stadiumName)
    {
        $this->stadiumName = $stadiumName;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Team
     */
    public function getHomeClub()
    {
        return $this->homeClub;
    }

    /**
     * @param Team $homeClub
     *
     * @return $this
     */
    public function setHomeClub($homeClub)
    {
        $this->homeClub = $homeClub;

        return $this;
    }

    /**
     * @return Team
     */
    public function getVisitor()
    {
        return $this->visitor;
    }

    /**
     * @param Team $visitor
     *
     * @return $this
     */
    public function setVisitor($visitor)
    {
        $this->visitor = $visitor;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function __populate(Array2Object $array2Object, array $data)
    {
        $this->setDate(new \DateTime($data['date']));
        $this->setStadiumName($data['stadium']);
        $this->setHomeClub($array2Object->createObject(Team::class, $data['homeClub']));
        $this->setVisitor($array2Object->createObject(Team::class, $data['visitor']));
    }

    /**
     * @inheritDoc
     */
    public function __toArray()
    {
        return [
            'date' => $this->getDate()->format('Y-m-d'),
            'stadium' => $this->getStadiumName(),
            'homeClub' => $this->getHomeClub(),
            'visitor' => $this->getVisitor(),
        ];
    }
}