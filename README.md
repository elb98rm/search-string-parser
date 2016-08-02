# search-string-parser

[![Latest Version](https://img.shields.io/github/release/elb98rm/search-string-parser.svg?style=plastic)](https://github.com/elb98rm/search-string-parser/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=plastic)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/search-string-parser/master.svg?style=plastic)](https://travis-ci.org/thephpleague/search-string-parser)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/search-string-parser/search-string-parser.svg?style=plastic)](https://scrutinizer-ci.com/g/thephpleague/search-string-parser/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/search-string-parser/search-string-parser.svg?style=plastic)](https://scrutinizer-ci.com/g/thephpleague/search-string-parser)
[![Total Downloads](https://img.shields.io/packagist/dt/league/search-string-parser.svg?style=plastic)](https://packagist.org/packages/league/search-string-parser)

A php based parser that will turn a string into an array of search terms for usage in search logic.
** This software is currently in a beta release: 0.9.3 **

It is to be released on [packagist.org](https://packagist.org/).

Items left to look at:

* Finish ParserEn implementation - currently under development
* Testing has been restored to 100% on files not being redeveloped
* Documentation to be expanded to be more "ELI5" 

This should be PSR-2, PSR-4 compliant, but as it's a beta there may be some problems.

## Install

Via Composer

``` bash
composer require league/search-string-parser
```

## Usage

Note - this has changed since 0.9.2.
 
There are different engines Parsers available. You can easily choose which you want to use. 
Currently in this Beta version ParserSimple and ParserEn are included.

Instantiate the wrapper using an object of the type of search you want:

``` php
// Instantiate 
$ssp = new SearchStringParser(new ParserSimple);
// run a search: 
$string = 'some search terms "including literals enclosed in quotes"';
$array = $ssp->parse($string);
```

This will give you the following results set:

``` php
array(
    0 => 'including literals enclosed in quotes',
    1 => 'some',
    2 => 'search',
    3 => 'terms'
);
```

Spaces are treated as "OR", with literals meaning "This string exactly"
 
* hello world => hello OR world
* "hello world" => hello AND [ space ] AND world

Your search string can include a combination of the following items: 

* strings - eg: hello world
* literal string - eg: "hello world"
* int - eg: 1
* float - eg: -14.54
* array
* multi-dimensional array

These are all parsed internally to form an array ready for you to use as you see fit!

Here is a more complex example: 

``` php
// Instantiate 
$ssp = new SearchStringParser(new ParserSimple);
// run a search: 
$complex = array(
            0 => 'hello world',
            1 => 'foo',
            2 => 'bar "literal string"',
            3 => 3,
            4 => -19.27
        );
$array = $ssp->parse($complex);
```

This gives the following result:
``` php
array(
    0 => 'literal string',
    1 => 'hello',
    2 => 'world',
    3 => 'foo',
    4 => 'bar',
    5 => '3',
    6 => '-19.27'
);
```

You can also change the delimiter:

``` php
// Instantiate 
$ssp = new SearchStringParser(new ParserSimple);
// run a search: 
$string = 'some "search terms" Pincluding literals enclosed in another letterP';
$array = $ssp->parse($string);
```

This will give you the following results set:

``` php
array(
    0 => 'including literals enclosed in another letter',
    1 => 'some',
    2 => '"search',
    3 => 'terms"'
);
```

A practical use case; In Zend Framework you may need to set up a set of search terms:
 
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

Ensure that you have run composer scripts to generate vendor/autoload.php
Run the following in command line at the project root:

``` bash
$ phpunit --bootstrap vendor/autoload.php tests/
```

## Credits

- [Rick morice](https://github.com/elb98rm)

## License

GNU GENERAL PUBLIC LICENSE. Please see [License File](LICENSE.md) for more information.
