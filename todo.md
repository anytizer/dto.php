uniform general.css, styles.css - use one
Generate: generate_selenium()
Generate: relay.php test scripts for API
CustomEloquentModel - produce once per generation, not per entity.
For cs/dto, use all column names.

Flags seem to appear in CRUD Templates:
    Visible
    Active
    _By
    _On
    _On

templates\phpunit\tests\apiunit.phpunit - split business.
Edit -> Link back to cancel/list.

pre-registered mantis bug id
http://192.168.1.76/tutor/web/mantis/public_html/view.php?id=37

in methodifier, portion of depends on non-composer class.

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

dto database hostname username password database > config.db

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
	Access control list
	Permissions
	Login

OF
	- entire writeup can be grouped inside the application

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

do not include flag columns in dto
synchronized test case and method names - via PSR/Snake Case
controller file write js has php tags

add crud into the menus somewhere else
do the acl for user groups
in business assign, read list of users only from available list

== acl, model ==

https://code.tutsplus.com/tutorials/a-better-login-system--net-3461
http://stackoverflow.com/questions/32060581/simple-php-mysql-acl-system
http://www.developer.com/lang/php/creating-a-custom-acl-in-php.html
for all module, public functions
	- allow a group?
