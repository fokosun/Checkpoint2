
[![Build Status](https://travis-ci.org/andela-fokosun/Checkpoint-Two.svg)](https://travis-ci.org/andela-fokosun/Checkpoint-Two)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/andela-fokosun/Checkpoint-Two/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/andela-fokosun/Checkpoint-Two/?branch=master)

# Checkpoint Two
Potato ORM is a really super simple agnostic ORM that can perform the basic crud database operations.

Let's get started

## Classes

Base - Defines all the CRUD Implementations functions that allows reading data from a particular table.
Every other class can inherit from the base class to access those functions so as to retrieve data.

DatabaseConnector - Implements the DatabaseInterface

Car (Child class)

Bicycle (Child class)

User (Child class)


## Testing
Phpunit 5.0 was used for testing the classes. Find the test file
[here](https://github.com/andela-fokosun/Checkpoint-Two/blob/master/tests/)

## Installation

Require via composer like so:

```
    composer require florence/potato
```

## Usage

So first things first as usual: Let's say you have a class user that extends the base class

    `
        class User extends Base
        {
     
        }
     `




Hey, i told you it was simple didn't I! Potato ORM is an open-source project, so please feel free to tell family 
and friends to use or contribute to Potato ORM.


## Contributing
Please check out [CONTRIBUTING](CONTRIBUTING.md) file for detailed contribution guidelines.


## License
See the bundled [LICENSE](LICENSE.md) file for more details.



**Happy Coding!**
