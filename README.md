# search-string-parser

[![Latest Version](https://img.shields.io/github/release/elb98rm/search-string-parser.svg?style=plastic)](https://github.com/elb98rm/search-string-parser/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=plastic)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/search-string-parser/master.svg?style=plastic)](https://travis-ci.org/thephpleague/search-string-parser)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/search-string-parser/search-string-parser.svg?style=plastic)](https://scrutinizer-ci.com/g/thephpleague/search-string-parser/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/search-string-parser/search-string-parser.svg?style=plastic)](https://scrutinizer-ci.com/g/thephpleague/search-string-parser)
[![Total Downloads](https://img.shields.io/packagist/dt/league/search-string-parser.svg?style=plastic)](https://packagist.org/packages/league/search-string-parser)

A php based parser that will turn a string into an array of search terms for usage in search logic.
This software is currently in a beta release: 0.9

It is to be released on https://packagist.org/.

Items left to look at:

* Finalise reliable project structure for versioned public release 

This should be PSR-2, PSR-4 compliant, but as it's a beta there may be some problems.

## Install

Via Composer

``` bash
$ composer require league/search-string-parser
```

## Usage

``` php
// instantiate
$ssp = new League\Floor9design\SearchStringParser\SearchStringParser();
// run a full parse
$string = 'some search terms "including literals enclosed in quotes"';
$array = $ssp->parse($string);
```

Your search string can include a combination of the following items: 

* strings - eg: hello world
* literal string - eg: "hello world"
* int - eg: 1
* float - eg: -14.54
* array
* multi-dimensional array

These are all parsed internally to form an array ready for you to use as you see fit!

For example - in Zend Framework you may need to set up a set of search terms:
 
 ``` php
 // we are in the middle of the code, and the object has already been instantiated as above:
  $string = 'some input text "including literals enclosed in quotes"';
 $array = $ssp->parse($string);
  // ... I'll now skip to the relevant part of zend - I assume you can write a query:
  foreach($array as $keyword) {
    $select->orWhere('data_table LIKE ?', "%$keyword%")
 }
 ```

Obviously, this is just a push in the right direction, though similar things can be done in almost all 
frameworks (as well as in raw SQL).

## Testing

``` bash
$ phpunit --bootstrap src/SearchStringParser.php tests/SearchStringParserTest.php
```

## Credits

- [Rick morice](https://github.com/elb98rm)

## License

GNU GENERAL PUBLIC LICENSE. Please see [License File](LICENSE.md) for more information.
