# Full stack source code generator


## Usage

    cd src
    php -f business.php

This is **not a general purpose software**. It helps developers to produce raw full stack source code from MySQL Database. It ambitiously covers:
 - AngularJS Components
 - API Endpoints
 - Unit Tests
 - ORM
 - HTML files

Output of this product is useful as a backbone of starting a new web project.


## Requirements:

* Business Definitions render
* __Complete MySQL Database__ for a project before generating a source code stack.
* An advanced PHP IDE like [PHPStorm](https://www.jetbrains.com/?from=anytizer) or [NetBeans](https://netbeans.org/).
* [Composer](https://getcomposer.org/)
* [Postman](https://www.getpostman.com/) or [relay.php](https://github.com/anytizer/relay.php) project
* [PHPUnit](https://phpunit.de/)


## Dependencies

The following sub-projects are necessary:

 * [Business Definition Files](https://github.com/anytizer/business.definitions) generated by [Business Definer](https://github.com/anytizer/definitions.business) project.
 * [API.php](https://github.com/anytizer/api.php) project for backend APIs
 * This project itself.
 * MySQL Database Connection shared between these projects.


## Installation

Checkout the required project.

    git clone https://github.com/anytizer/definitions.business.git
    git clone https://github.com/anytizer/business.definitions.git
    git clone https://github.com/anytizer/dto.php.git

    cd dto.php
    composer update

Edit: `inc.config.php` for:

 * MySQL Database Connection details
 * Path to business definition files

 
     cd src
     php -f business.php

     
See files output directory.


## ATTN

This project may be broken due to several reasons:
 - requirement of full paths in configurations
 - composer modules
 - dependent project files
 - work in progress

The source code is available for a reference only.
