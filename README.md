# Symfony3 Simple Membership App

### You will need:
  * Git 
  * PHP 5.6+
  * MySql
  * composer

## Installation
To get the website running, first clone the repository:

    $ git clone https://github.com/DraganValjak/Symfony3-Simple-Membership-App.git  projectname
    $ cd projectname
	$ composer install

This will fetch the vendors and all it's dependencies.

The next step is to setup the database:

    $ bin/console doctrine:database:create
    $ bin/console doctrine:schema:update --force
    $ bin/console doctrine:fixtures:load


## Access by web browser
   
    $ bin/console server:run
    

Then point your browser to 127.0.0.1:8000

## Running the Application ##

* `You can access the application from 127.0.0.1:8000`
* `Username: admin+1@site.com`
* `Password: 1234`


## Possibilities ##

* `Mmember List`
* `Adding and editing members`
* `Add notes to each member`
* `Viewing birthday in the current month`
* `Showing members with expired membership fees`
* `A list of notes for the last three month`

