search-string-parser
====================

# League Skeleton

[![Latest Version](https://img.shields.io/github/release/thephpleague/skeleton.svg?style=plastic)](https://github.com/elb98rm/search-string-parser)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=plastic)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/search-string-parser/master.svg?style=plastic)](https://travis-ci.org/thephpleague/skeleton)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/search-string-parser/skeleton.svg?style=plastic)](https://scrutinizer-ci.com/g/thephpleague/skeleton/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/search-string-parser/skeleton.svg?style=plastic)](https://scrutinizer-ci.com/g/thephpleague/skeleton)
[![Total Downloads](https://img.shields.io/packagist/dt/league/search-string-parser.svg?style=plastic)](https://packagist.org/packages/league/skeleton)

A php based parser that will turn a string into an array of search terms for usage in search logic.
This is in the process of being finished and then extended.
The long term aim is to release this on https://packagist.org/.

Items left to look at:

1) Completing the software! Currently this is regarded as pre-alpha.
2) Writing phpunit tests

Currently still under development. :)

This will eventually be PSR-2, PSR-4 compliant. It's probably a long way off right now!

## Install

Via Composer

``` bash
$ composer require league/search-string-parser
```

## Usage

``` php
$search-string-parser = new League\SearchStringParser();
echo $skeleton->echoPhrase('Hello, League!');
```

## Testing

``` bash
$ phpunit
```

## Credits

- [:Rick morice](https://github.com/:elb98rm)

## License

GNU GENERAL PUBLIC LICENSE. Please see [License File](LICENSE.md) for more information.
