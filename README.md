# lib-array2object

[![Build Status](https://travis-ci.org/rafrsr/lib-array2object.svg?branch=master)](https://travis-ci.org/rafrsr/lib-array2object)
[![Coverage Status](https://coveralls.io/repos/github/rafrsr/lib-array2object/badge.svg?branch=master)](https://coveralls.io/github/rafrsr/lib-array2object?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rafrsr/lib-array2object/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rafrsr/lib-array2object/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/rafrsr/lib-array2object/version)](https://packagist.org/packages/rafrsr/lib-array2object)
[![Latest Unstable Version](https://poser.pugx.org/rafrsr/lib-array2object/v/unstable)](//packagist.org/packages/rafrsr/lib-array2object)
[![Total Downloads](https://poser.pugx.org/rafrsr/lib-array2object/downloads)](https://packagist.org/packages/rafrsr/lib-array2object)
[![License](https://poser.pugx.org/rafrsr/lib-array2object/license)](https://packagist.org/packages/rafrsr/lib-array2object)

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

## Serialization

This library can be used to serialize/deserialize objects without a complex configuration.

#### Json
````php
//deserialize
$json = '{"name":"David","number"=>"1"}';
$object = Array2ObjectBuilder::create()->build()->createObject(Team::class, json_decode($json, true));
echo $object->getName()//David

//serialize
$array = Object2ArrayBuilder::create()->build()->createArray($object);
echo json_encode($array); // {"name":"David","number"=>"1"}
````

#### Xml

Using the library [rafrsr/lib-array2xml](https://github.com/rafrsr/lib-array2xml) is very handy convert from/to xml

````php
//deserialize
$xml = '<Player><name>Player 1</name><number>1</number></Player>';
$object = Array2ObjectBuilder::create()->build()->create(Team::class, XML2Array::createArray($xml));
echo $object->getName()//David

//serialize
$array = Object2ArrayBuilder::create()->build()->createArray($object);
echo Array2XML::createXml('Player', $array); //  '<Player><name>Player 1</name><number>1</number></Player>'
````

> This library its handy to use and has some advanced configuration,
> but in some cases (need groups, versions and other stuffs) is required use advanced libraries like 
> [jms/serializer](https://github.com/schmittjoh/serializer)

## Documentation

Full documentation are available on the [wiki page](https://github.com/rafrsr/lib-array2object/wiki)

## Copyright

This project is licensed under the [MIT license](LICENSE).