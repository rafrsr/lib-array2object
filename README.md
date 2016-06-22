# lib-array2object

[![Build Status](https://travis-ci.org/rafrsr/lib-array2object.svg?branch=master)](https://travis-ci.org/rafrsr/lib-array2object)
[![Coverage Status](https://coveralls.io/repos/github/rafrsr/lib-array2object/badge.svg?branch=master)](https://coveralls.io/github/rafrsr/lib-array2object?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rafrsr/lib-array2object/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rafrsr/lib-array2object/?branch=master)

Array to object conversion library. Convert a array to a object using simple and common property annotations

# Usage

Having the following classes:

````php
class Team
{
    /**
     * @var string
     */
    protected $name;
    
     /**
     * @var array|Player[]
     */
    protected $players;

    //getters and setters
}

class Player
{
    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var integer
     */
    protected $number;
    
    //getters and setters
}
````

And this array

````php
$teamArray = [
    'name' => 'Dream Team',
    'players' =>
        [
          [
            'name' => 'Player 1',
            'number' => '1',
          ]
        ],
    ];
````

Can use:

````php
    $team = Array2Object::createObject(Team::class, $teamArray);
    echo $team->getName(); //Dream Team
    echo $team->getPlayers()[0]->getName() //Player 1
````

# How it works

This library only use phpDocBloc common properties like `@var` and try to resolve the type of data or related object.

### Example:

````php 
/** @var integer **/
$property
````

### Available types:

| Type           | Description                                                             |
|----------------|-------------------------------------------------------------------------|
| integer        | Primitive integer                                                       |
| int            | Primitive integer                                                       |
| boolean        | Primitive boolean                                                       |
| bool           | Primitive boolean                                                       |
| float          | Primitive float                                                         |
| double         | Primitive float                                                         |
| string         | Primitive string                                                        |
| array          | An array with arbitrary keys, and values.                               |
| array\|\<Object\>[]| Array of *\<Object\>* instance. The _\<Object\>_ should be the class to use. |