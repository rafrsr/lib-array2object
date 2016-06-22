# lib-array2object

[![Build Status](https://travis-ci.org/rafrsr/lib-array2object.svg?branch=master)](https://travis-ci.org/rafrsr/lib-array2object)
[![Coverage Status](https://coveralls.io/repos/github/rafrsr/lib-array2object/badge.svg?branch=master)](https://coveralls.io/github/rafrsr/lib-array2object?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rafrsr/lib-array2object/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rafrsr/lib-array2object/?branch=master)

Array to object conversion library. Convert a array to a object using simple and common property annotations

## Installation

1. [Install composer](https://getcomposer.org/download/)
2. Execute: `composer require rafrsr/lib-array2object`

## Usage

````php
$phpArray = ['name' => 'David', 'number' => '1'];
$object = Array2ObjectBuilder::create()->build()->createObject(Player::class, $phpArray);
echo $object->getName();//David
echo $object->getNumber();//1

$array = Object2ArrayBuilder::create()->build()->createArray($object);
echo $array['name'];//David
echo $array['number'];//1
````

## Documentation

Full documentation are available on the [wiki page](https://github.com/rafrsr/lib-array2object/wiki)

## Copyright

This project is licensed under the [MIT license](LICENSE).