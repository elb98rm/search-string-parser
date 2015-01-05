# search-string-parser

[![Latest Version](https://img.shields.io/github/release/elb98rm/search-string-parser.svg?style=plastic)](https://github.com/elb98rm/search-string-parser/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=plastic)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/search-string-parser/master.svg?style=plastic)](https://travis-ci.org/thephpleague/search-string-parser)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/search-string-parser/search-string-parser.svg?style=plastic)](https://scrutinizer-ci.com/g/thephpleague/search-string-parser/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/search-string-parser/search-string-parser.svg?style=plastic)](https://scrutinizer-ci.com/g/thephpleague/search-string-parser)
[![Total Downloads](https://img.shields.io/packagist/dt/league/search-string-parser.svg?style=plastic)](https://packagist.org/packages/league/search-string-parser)

A php based parser that will turn a string into an array of search terms for usage in search logic.
This is in the process of being finished and then extended.
It is to be released on https://packagist.org/.

Items left to look at:

1) Implement mixed input work
2) Update README, implement phpdocs etc. 
3) Move from alpha to a beta (finalise reliable project structure for public beta release) 

This will eventually be PSR-2, PSR-4 compliant. It's probably a long way off right now!

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
$array = $ssp->parse($string);
```

## Testing

``` bash
$ phpunit
```

## Credits

- [:Rick morice](https://github.com/:elb98rm)

## License

GNU GENERAL PUBLIC LICENSE. Please see [License File](LICENSE.md) for more information.
