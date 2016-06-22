# lib-array2object

[![Build Status](https://travis-ci.org/rafrsr/lib-array2object.svg?branch=master)](https://travis-ci.org/rafrsr/lib-array2object)
[![Coverage Status](https://coveralls.io/repos/github/rafrsr/lib-array2object/badge.svg?branch=master)](https://coveralls.io/github/rafrsr/lib-array2object?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rafrsr/lib-array2object/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rafrsr/lib-array2object/?branch=master)

Array to object conversion library. Convert a array to a object using simple and common property annotations

## Usage

Can use:

````php
    $person = Array2ObjectBuilder::create()->build()->createObject(Person::class, ['name' => 'David Smith', 'age' => '18']);
    echo $person->getName(); //David Smith
````

## How it works

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
| array\|\<type\>[]| Array of *\<Type\>*. The _\<type\>_ should be one scalar type. |
| array\|\<Object\>[]| Array of *\<Object\>* instance. The _\<Object\>_ should be the class to use. |
| DateTime       | Instance of \DateTime class                                             |

### Property Names

Property names are compared using some versions of the same property name.

`$propertyName -> 'propertyName' -> 'property_name' -> propertyname`

### Setters

Setters methods are required to set the property value, otherwise the property is not settled.

````php
public function setPropertyName()
````

## Copyright

This project is licensed under the [MIT license](LICENSE).