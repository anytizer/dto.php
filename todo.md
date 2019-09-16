urlpart.html: lowercase template lookup

For cs/dto, use full column names.
Auto Truncate flag columns for display.
    - in tabular form
    - in edit forms
    - in details pages
Append .html to Search, Flag, ... when loading templates.

List controller to contain flag method.
details controller to contain delete method.
#__PRIMARY_KEY__ not replaced in angular controller.
PHPUnit LogIncomplete...

Flags seem to appear in CRUD Templates:
    Visible
    Active
    _By
    _On
    _On

templates\phpunit\tests\apiunit.phpunit - remove business.

Edit controller to have prefetching details.
services.js:
    const APIURL = "../api.php/src";
    let url = APIURL + "/inventory/NiWarehouses/" + urlpart;
Do not crud for AngularJS Components, if defaulted.
Remove JS auto CRUD functions.

Edit -> Link back to cancel/list.
var NiCyclesApp = myApp; == in router.js
    - router
    - directives
    - services
    - controller
replace var with const or let.
rename controller -> controllers

http://192.168.1.76/tutor/web/mantis/public_html/view.php?id=37

in methodifier, portion of depends on non-composer class.

Caser - project split into its own to provide test cases

Write model body with column names pre-populated.

ID field missing full name in CS.DTO:
	public string ID { get; set; }

$hidden fields for Laravel ORM.

Faker database for all tables.

add, edit, list, flag orm: pass $parameter.
Move emails/ into templates API.

Make UI Router compatible URLs.
eg. edit({}) for /#!/edit...

templateUrl: template("AddContacts"), => add-contacts.html

column_display() appears twice...

.HTML ending
Loading: http://localhost/angular/libraries/dto.php/output/public_html/entities/WorldMaps/Countries/html/EditCountry
Countries-routes.js:11:3
Loading: http://localhost/angular/libraries/dto.php/output/public_html/entities/WorldMaps/Countries/html/Flag
/entities/MyDirectory/Contacts/html/DeleteContacts => html/delete-contacts.html

Solidarity; in .ts files at templates\public_html\entities\js\angularjs

dto database hostname username password database > config.db
dto output /tmp/
dto phpunit
dto apiunit
dto api
dto angularjs
dto css

composer require anytizer/capitalizer.php:dev-master
composer require anytizer/guid.php:dev-master
composer require anytizer/includer.php:dev-master


List page column names are wrong.

Method Name is wrong in method descriptor.
DTO Fields to have comments
Featured test does not need API, phpunit test only
DTO name to support multi words
Common output folder from all write template calls
Writing template file is a separate logic

Register role, method to the database at the time of generation
Generate endpoints inside proper namespace
Generate test units inside proper namespace
Generate API Classes inside proper namespace
Break into packages, modules, functions for Unit Tests
Unit tests can repeat by their class names.
PHPUnit methods and class methods appear as interfaces only
Verify that
	- table name passed exists - business()

Buzz words
	Account
	Profile
	Users
	Credentials
	Access control list
	Permissions
	Management
	Login

OF
	- entire writeup can be grouped inside the application
	- bunches of DTOs grouped together
	- eg. treat one defined as a unit

Generate
	- HTML Menu
	- HTML Linking

Function return ype support
	- get last crawled on: date


Should read from database rows for the models and HTMLs.

Use of "global" variables to be discouraged.
Produce PHP Unit Tests scripts as well.
non-repeating replacement management for templates and units
produce html files
write api endpoints
do not continue for models without table names.
do not allow repeated table names
do not allow repeated model names (managed)

not all models require full crud
	crud = add, edit, delete, details, lists, flag
		write only: eg logs
		read only: eg configs
		flags: delete, flag, activate, suspended

parameterize
	add(,,) - to take 2 arguments

do not include flag columns in dto
synchronized test case and method names - via PSR/Snake Case
controller file write js has php tags


produce all fields
run phpunit tests to pass
produce endpoint handlers
see records in the database
attach the angular js files in the HTMLs
add crud into the menus somewhere else
do the acl for user groups
in business assign, read list of users only from available list

acl, model ==
https://code.tutsplus.com/tutorials/a-better-login-system--net-3461
http://stackoverflow.com/questions/32060581/simple-php-mysql-acl-system
http://www.developer.com/lang/php/creating-a-custom-acl-in-php.html
for all module, public functions
	- allow a group?
