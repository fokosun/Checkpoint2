
[![Build Status](https://travis-ci.org/andela-fokosun/Checkpoint-Two.svg)](https://travis-ci.org/andela-fokosun/Checkpoint-Two)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/andela-fokosun/Checkpoint-Two/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/andela-fokosun/Checkpoint-Two/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/florence/potato/v/stable)](https://packagist.org/packages/florence/potato)
[![Total Downloads](https://poser.pugx.org/florence/potato/downloads)](https://packagist.org/packages/florence/potato)
[![License](https://poser.pugx.org/florence/potato/license)](https://packagist.org/packages/florence/potato)

# Checkpoint Two
Potato ORM is a really super simple agnostic ORM that can perform the basic crud database operations.

Let's get started

## Classes

- **Model** - Implements the Model Interface. User, Car example classes extend this class.

- **Connection** - Loads and reads the .env file, returns the PDO connection object

- **WordNotFoundException** - It is what it is, an exception class!

- **User, Car** - Example classes, they extend the Model class



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

**Uh, Oh update an existing record: A combination of the find and save methods**

        $user = User::find(3);
        $user->name = “Beetle”;
        $user->save();        
        
Nice and straight forward. Hey, i told you it was simple didn't I! 

`NB: You can only update one field at a time in this version.`

So you cannot do:
        
        &user = User::find(3);
        $user->first_name = "Lindsay";
        $user->Last_name = "Mark";
        $user->save();

`NB: Make sure you are updating fields already present in your database.` 

If you attempt to assign a property that doesn't exist in your databse, expect an exception. Make sure to handle the exception e.g.
            
            try {
                    $user = User::find(20);
                } catch(\Florence\RecordNotFoundException $e) {
                    echo $e->getExceptionMessage();
                }

Potato ORM is an open-source project, so please feel free to tell family and friends to use or contribute to Potato ORM.

**Happy Coding!**
