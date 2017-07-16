[![Build Status](https://travis-ci.org/andela-fokosun/Checkpoint2.svg?branch=master)](https://travis-ci.org/andela-fokosun/Checkpoint2)


# Potato ORM
Potato ORM is a really super simple agnostic ORM that can perform the basic crud database operations.

Let's get started

## Classes

- **Model** - Implements the Model Interface. User, Car example classes extend this class.

- **Connection** - Loads and reads the .env file, returns the PDO connection object

- **RecordNotFoundException** - An exception class, triggered when 
table name is not found in database.

- **User, Car** - Example classes, they extend the Model class.


## Testing
Phpunit 5.0 was used for testing the classes. Find the test file
[here](https://github.com/andela-fokosun/Checkpoint-Two/blob/master/tests/)

## Installation

Require via composer like so:

```
    composer require florence/potato
```

## Usage

So first things first as usual: Let's say you have a class **User** that extends the base class

    
        class User extends Model
        {
     
        }
        
**create a new instance of your class like so:**

        $user = new User();
        
**add the respective column names and populate values as you wish:**

        $user->first_name = "Florence";
        $user->last_name = "Okosun";
        $user->stack = "PHP/Laravel";
        
**call the save method on the user instance:**

        $user->save();

**to fetch all the entries in the databsase:**

        $user = User::getAll();


**to find a particular record, say the third record:**

        $user = User::find(3);

**how about deleting a record?**

        $user = User::destroy(1);

**Updating an existing record:**

        &user = User::find(3);
        $user->first_name = "Lindsay";
        $user->Last_name = "Mark";
        $user->save();     
        


`NB: The save() method checks first to see if the id exists. if yes, it calls the upadte method else calls the create method` 

Nice and straight forward. Hey, i told you it was simple didn't I! 

Potato ORM is an open-source project, so please feel free to tell family and friends to use or contribute to Potato ORM.

**Happy Coding!**
