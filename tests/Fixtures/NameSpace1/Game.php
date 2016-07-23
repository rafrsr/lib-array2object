<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Tests\Fixtures\NameSpace1;

use Rafrsr\LibArray2Object\Array2ObjectBuilder;
use Rafrsr\LibArray2Object\Array2ObjectInterface;
use Rafrsr\LibArray2Object\Object2ArrayInterface;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;

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
     * {@inheritdoc}
     */
    public function __populate(array $data)
    {
        $this->setDate(new \DateTime($data['date']));
        $this->setStadiumName($data['stadium']);

        $array2Object = Array2ObjectBuilder::create()->build();
        $this->setHomeClub($array2Object->createObject(Team::class, $data['homeClub']));
        $this->setVisitor($array2Object->createObject(Team::class, $data['visitor']));
    }

    /**
     * {@inheritdoc}
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
