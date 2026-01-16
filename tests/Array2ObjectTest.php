<?php

/*
 * This file is part of the rafrsr/lib-array2object package.
 *
 * (c) Rafael SR <https://github.com/rafrsr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rafrsr\LibArray2Object\Tests;

use PHPUnit\Framework\TestCase;
use Rafrsr\LibArray2Object\Array2ObjectBuilder;
use Rafrsr\LibArray2Object\Matcher\MapMatcher;
use Rafrsr\LibArray2Object\Parser\CallableParser;
use Rafrsr\LibArray2Object\Tests\Fixtures\Team;

class Array2ObjectTest extends TestCase
{
    public function testArray2Object()
    {
        $teamArray = [
            'id' => 1, //read-only
            'name' => 'Dream Team',
            'Manager' => [
                'name' => 'Big Manager',
                'salary' => '$10000',
            ],
            'createdAt' => '2016-01-01',
            'points' => '25',
            'players' => [
                [
                    'name' => 'Player 1',
                    'number' => '1',
                    'height' => '1.80',
                    'regular' => 'true',
                ],
                [
                    'name' => 'Player 2',
                    'number' => '2',
                    'height' => '1.85',
                    'regular' => 0,
                ],
                [
                    'name' => 'Player 3',
                    'number' => '3',
                    'height' => '1.78',
                    'regular' => 'yes',
                ],
            ],
            'scores' => [
                '2016' => '29',
                '2015' => '28',
                '2014' => '30',
            ],
        ];

        //register custom parser
        $array2Object = Array2ObjectBuilder::create()->addParser(
            new CallableParser(
                function ($value, $type, \ReflectionProperty $property, $object) {
                    if ($property->getName() === 'salary') {
                        $value = str_replace('$', '', $value);
                    }

                    return $value;
                }
            )
        )->build();

        /** @var Team $team */
        $team = $array2Object->createObject(Team::class, $teamArray);
        static::assertNull($team->getId());
        static::assertEquals('Dream Team', $team->getName());
        static::assertEquals(25, $team->getPoints());
        static::assertEquals(29, $team->getScores()[2016]);
        static::assertEquals('2016-01-01', $team->getCreatedAt()->format('Y-m-d'));

        static::assertEquals('Big Manager', $team->getManager()->getName());
        static::assertEquals(10000, $team->getManager()->getSalary());

        static::assertEquals('Player 1', $team->getPlayers()[0]->getName());
        static::assertEquals(1, $team->getPlayers()[0]->getNumber());
        static::assertEquals(1.80, $team->getPlayers()[0]->getHeight());
        static::assertTrue($team->getPlayers()[0]->isRegular());

        static::assertEquals('Player 2', $team->getPlayers()[1]->getName());
        static::assertEquals(2, $team->getPlayers()[1]->getNumber());
        static::assertEquals(1.85, $team->getPlayers()[1]->getHeight());
        static::assertFalse($team->getPlayers()[1]->isRegular());

        static::assertTrue($team->getPlayers()[2]->isRegular());

        static::assertIsString($team->getName());
        static::assertIsInt($team->getPoints());
        static::assertIsFloat($team->getManager()->getSalary());
        static::assertIsBool($team->getPlayers()[0]->isRegular());
        static::assertIsFloat($team->getPlayers()[0]->getHeight());
        static::assertIsBool($team->getPlayers()[2]->isRegular());
        static::assertIsInt($team->getScores()[2016]);

        $teamArray = [
            'name' => 'New Name',
        ];

        $array2Object->populate($team, $teamArray);
        static::assertEquals('New Name', $team->getName());
    }

    /**
     * @see https://github.com/rafrsr/lib-array2object/issues/1
     */
    public function testArray2ObjectWithNestingChildren()
    {
        $teamArray = [
            'name' => 'Dream Team',
            'players' => [
                'player' => [
                    [
                        'name' => 'Player 1',
                        'number' => '1',
                        'height' => '1.80',
                        'regular' => 'true',
                    ],
                    [
                        'name' => 'Player 2',
                        'number' => '2',
                        'height' => '1.85',
                        'regular' => 0,
                    ],
                ],
            ],
        ];

        $array2Object = Array2ObjectBuilder::create()->build();

        /** @var Team $team */
        $team = $array2Object->createObject(Team::class, $teamArray);
        static::assertEquals('Dream Team', $team->getName());

        static::assertEquals('Player 1', $team->getPlayers()[0]->getName());
        static::assertEquals(1, $team->getPlayers()[0]->getNumber());
        static::assertEquals(1.80, $team->getPlayers()[0]->getHeight());
        static::assertTrue($team->getPlayers()[0]->isRegular());

        static::assertEquals('Player 2', $team->getPlayers()[1]->getName());
        static::assertEquals(2, $team->getPlayers()[1]->getNumber());
        static::assertEquals(1.85, $team->getPlayers()[1]->getHeight());
        static::assertFalse($team->getPlayers()[1]->isRegular());
    }

    public function testArray2ObjectWithNestingChildrenOnlyOne()
    {
        //with only one children
        //https://github.com/rafrsr/lib-array2object/issues/1#issuecomment-228155603
        $teamArray = [
            'name' => 'Dream Team',
            'players' => [
                'player' => [
                    'name' => 'Player 1',
                    'number' => '1',
                    'height' => '1.80',
                    'regular' => 'true',
                ],
            ],
        ];

        $array2Object = Array2ObjectBuilder::create()->build();

        /** @var Team $team */
        $team = $array2Object->createObject(Team::class, $teamArray);
        static::assertEquals('Dream Team', $team->getName());
        static::assertEquals('Player 1', $team->getPlayers()[0]->getName());
        static::assertEquals(1, $team->getPlayers()[0]->getNumber());
        static::assertEquals(1.80, $team->getPlayers()[0]->getHeight());
        static::assertTrue($team->getPlayers()[0]->isRegular());
    }

    public function testPopulateObjectError()
    {
        $this->expectException(\InvalidArgumentException::class);
        Array2ObjectBuilder::create()->build()->populate(Team::class, []);
    }

    public function testCreateObjectError()
    {
        $this->expectException(\InvalidArgumentException::class);
        Array2ObjectBuilder::create()->build()->createObject(new Team(), []);
    }

    public function testSettingPropertyMatcher()
    {
        $array2Object = Array2ObjectBuilder::create()->setMatcher(
            new MapMatcher(
                [
                    'name' => 'nombre',
                ]
            )
        )->build();
        /** @var Team $team */
        $team = $array2Object->createObject(Team::class, ['nombre' => 'Team']);
        static::assertEquals('Team', $team->getName());
    }

    public function testDeserializeJson()
    {
        $json = '{"name":"Big Team","players":[{"name":"Player 1"}]}';
        /** @var Team $team */
        $team = Array2ObjectBuilder::create()->build()->createObject(Team::class, json_decode($json, true));
        static::assertEquals('Big Team', $team->getName());
        static::assertEquals('Player 1', $team->getPlayers()[0]->getName());
    }
}
