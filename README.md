[![Coverage Status](https://coveralls.io/repos/github/andela-fokosun/Checkpoint2/badge.svg?branch=master)](https://coveralls.io/github/andela-fokosun/Checkpoint2?branch=master)    [![Build Status](https://travis-ci.org/andela-fokosun/Checkpoint2.svg?branch=master)](https://travis-ci.org/andela-fokosun/Checkpoint2)

# Potato ORM
Potato ORM is a simple and very basic ORM that can perform the basic crud database operations.

## Installation

Require via composer:

```
    composer require florence/potato
```

## Usage

- make sure to establish a connection to your database
- create your database tables using pluralized names e.g users, cars.
- define the table schema e.g users table schema could look like 
:point_right: [username, email, password, phone]
- when the above is set, you can start using potatoORM

#### Example
- create a model

        class User extends Model
        {
            // add methods that are not available in parent class
        }
        
- create a new instance of the model you created

        $user = new User();
        
- add the respective column names and assign values

        $user->username = "johndoe";
        $user->email = "john@doe.com";
        $user->phone = "08067890986";
        
- save

        $user->save();

- fetch all users

        $user = User::getAll();

- find one user

        $user = User::find(1);

- delete one user

        $user = User::destroy(1);

- update user record

        &user = User::find(3);
        $user->username = "Lindsay";
        $user->email = "lindsay@africa.com";
        $user->save();     
        

Potato ORM is an open-source project and still pretty much work in 
progress. It does not handle table relationships as at this version 
and can only carry out simple crud operations. Please feel free to 
contribute to make this as awesome as it can get.

**Happy Coding!**
