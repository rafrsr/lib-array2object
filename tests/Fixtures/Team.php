<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\LibArray2Object\Tests\Fixtures;

use Rafrsr\LibArray2Object\Tests\Fixtures\NameSpace2\Manager as Trainer;

class Team extends AbstractTeam
{
    /**
     * @var Trainer
     */
    protected $manager;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var integer
     */
    protected $points;

    /**
     * @var array|Player[]|[]
     */
    protected $players;

    /**
     * @var array|integer[]
     */
    protected $scores;

    /**
     * @return Trainer
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param Trainer $manager
     *
     * @return $this
     */
    public function setManager($manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     *
     * @return $this
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return array|Player[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param array|Player[] $players
     *
     * @return $this
     */
    public function setPlayers($players)
    {
        $this->players = $players;

        return $this;
    }

    /**
     * @return array
     */
    public function getScores()
    {
        return $this->scores;
    }

    /**
     * @param array $scores
     *
     * @return $this
     */
    public function setScores($scores)
    {
        $this->scores = $scores;

        return $this;
    }
}