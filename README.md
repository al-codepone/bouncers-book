# Bouncer's Book

Bouncer's Book is a PHP form validator.
The first release is still in development.
This readme is unfinished.

## Documentation

This [README](https://github.com/al-codepone/bouncers-book/blob/master/README.md)
is currently the only documentation.

## Requirements

**PHP 5.3** or higher and [Composer](https://getcomposer.org/).
The [tests](https://github.com/al-codepone/bouncers-book/tree/master/test)
require [Corn Wand](https://github.com/al-codepone/corn-wand).


## Source Code

The [project](https://github.com/al-codepone/bouncers-book) is on GitHub.
The source code is [one class](https://github.com/al-codepone/bouncers-book/blob/master/src/bbook/FormValidator.php).

## Tests

All the tests are in the [test directory](https://github.com/al-codepone/bouncers-book/tree/master/test).
Each PHP script in the top level test directory is a separate test.
You need to run `composer install` in the test directory before running any of the tests.
Tests 1-3 test the first, second and third constructor parameters respectively.
Test 4 tests the `more()` method.

## Installation

Install using composer:

```javascript
{
    "require": {
        "bouncers-book/bouncers-book": "dev-master",
    }
}
```

## LICENSE

MIT <http://ryf.mit-license.org/>
