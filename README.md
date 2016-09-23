# Hair Salon #

#### An application to practice BDD and tests in PHP, September 23rd, 2016

#### By Mark Lawson

## Description ##

This application is an exercise in PHP BDD testing. It serves as a tool for a hair salon to track its stylists and clients, with the ability to manage which clients belong to each stylist. The application is built with PHP, using the Silex framework, Twig templates, and Bootstrap for styling.

## Setup/Installation Instructions ##

* Clone the repository
* Using the command line, navigate to the project's root directory
* Install dependencies by running $ composer install
* Sign into MySQL shell by running $ /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
* Start MAMP server and go to MAMP preferences:
    * Set Document Root to project's root directory
    * In the app/app.php project file, make sure the $server variable points to the localhost port listed under Ports>MySQL port in MAMP
* In a browser, go to http://localhost/phpmyadmin
* Select Import from the top menu and choose the compressed .sql files from the projects root directory and click 'Go' to import the databases
* Navigate to the /web directory and start a local server with $ php -S localhost:8000
* Open a browser and go to the address http://localhost:8000 to view the application

## MySQL Setup

* CREATE DATABASE hair_salon;
* USE hair_salon;
* CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR (255));
* CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR (255), stylist_id INT);
* (copy database in phpmyadmin to create hair_salon_test)

## Specifications

* The program will save new stylists
    * Example input: Susan
    * Example output: stylist 1

* The program will return all stylists
    * Example input: Susan, Jill
    * Example output: stylist 1, stylist 2

* The program will delete all stylists
    * Example input: Susan, Jill
    * Example output: false

* The program will return a specific stylist by id
    * Example input: 1
    * Example output: Susan

* The program will edit stylists
    * Example input: Susan
    * Example output: Susanne

* The program will delete specific stylists
    * Example input: Susan
    * Example output: false

* The program will save new clients
    * Example input: Bob
    * Example output: client 1

* The program will return all clients
    * Example input: Bob, Bill
    * Example output: client 1, client 2

* The program will delete all clients
    * Example input: Bob, Bill
    * Example output: false

* The program will return a specific client by id
    * Example input: 1
    * Example output: Bob

* The program will edit clients
    * Example input: Bob
    * Example output: Robert

* The program will delete specific clients
    * Example input: Bob
    * Example output: false

* The program will return all clients of a specific stylist
    * Example input: Jill
    * Example output: client 1, client 2

* While deleting a stylist, the program will also delete of that their clients
    * Example input: Susan & Bob
    * Example output: false

## Known Bugs ##

There are no known bugs at this time.

## Support and Contact Details ##

Please report any bugs or issues to mlawson3691@gmail.com.

## Languages/Technologies Used ##

* PHP
* Silex
* Twig
* PHPUnit
* Bootstrap

### License ###

*This application is licensed under the MIT license.*

Copyright (c) 2016 Mark Lawson
