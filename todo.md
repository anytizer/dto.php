Apply search on visible columns when in list mode.
Validate data at controller level.
Keep log when something is updated.
When delete, confirm no, redirects to /units. fix.

Hash check write of files (html, api, js): do not overwrite files modified by hand.
No print css for action columns in listing page.
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
    _Of

templates\phpunit\tests\apiunit.phpunit - split business.
Edit -> Link back to cancel/list.

pre-registered mantis bug id
http://192.168.1.76/tutor/web/mantis/public_html/view.php?id=37

in methodifier, portion of depends on non-composer class.

Write model body with column names pre-populated.

ID field missing full name in CS.DTO:
	public string ID { get; set; }

Faker database for all tables.

add, edit, list, flag orm: pass $parameter.
Move emails/ into templates API.

DTO Fields to have comments
Featured test does not need API, phpunit test only
DTO name to support multi words
Common output folder from all write template calls
Writing template file is a separate logic

Register role, method to the database at the time of generation
Generate endpoints inside proper namespace
Generate test units inside proper namespace
Break into packages, modules, functions for Unit Tests
Unit tests can repeat by their class names.

Buzz words
	Access control list
	Permissions
	Login

OF
	- entire writeup can be grouped inside the application

Use of "global" variables to be discouraged.
Produce PHP Unit Tests scripts as well.
non-repeating replacement management for templates and units

not all models require full crud
	crud = add, edit, delete, details, lists, flag
		write only: eg logs
		read only: eg configs
		flags: delete, flag, activate, suspended

synchronized test case and method names - via PSR/Snake Case

add crud into the menus somewhere else
do the acl for user groups, not per user
in business: assign, read list of users only from available list

== acl, model ==

https://code.tutsplus.com/tutorials/a-better-login-system--net-3461
http://stackoverflow.com/questions/32060581/simple-php-mysql-acl-system
http://www.developer.com/lang/php/creating-a-custom-acl-in-php.html
for all module, public functions
	- allow a group?
