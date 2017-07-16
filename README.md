[![Build Status](https://travis-ci.org/andela-fokosun/Checkpoint2.svg?branch=master)](https://travis-ci.org/andela-fokosun/Checkpoint2)

# Potato ORM
Potato ORM is a really super simple agnostic ORM that can perform the basic crud database operations.

## Installation

Require via composer:

```
    composer require florence/potato
```

## Usage

- make sure to establish a connection your database
- create your database tables using pluralized names e,g users, cars.
- define the table schema e.g users table will look something like 
[username, email, password, phone]
- when the above is set, you can start using potatoORM

#### Example
- create a model

        class User extends Model
        {
            // add methods that are not availble in parent class
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

        $user = User::find(3);

- delete one user

        $user = User::destroy(1);

- update user record

        &user = User::find(3);
        $user->first_name = "Lindsay";
        $user->Last_name = "Mark";
        $user->save();     
        


`NB: The save() method checks first to see if the id exists. if yes, it calls the upadte method else calls the create method` 

Nice and straight forward. Hey, i told you it was simple didn't I! 

Potato ORM is an open-source project, so please feel free to tell family and friends to use or contribute to Potato ORM.

**Happy Coding!**
