Show selected date fields in add, edit, details pages
package name needs to be readable in html files, eg. Purchase Orders for PurchaseOrder
Synchronize inactive icons: book open, book closed, add, list, cancel
Column default value set to null for zero ("0") in controller.

When updated, set modified on field.
Keep log when something is updated.

Hash check write of files (html, api, js): do not overwrite files modified by hand.
Generate: generate_selenium() to cover all visible columns
Generate: relay.php test scripts for API
CustomEloquentModel - produce once per generation, not per entity.
For cs/dto, use all column names.

templates\phpunit\tests\apiunit.phpunit - split business.

pre-registered mantis bug id - in production mode, register once per any amount of crud
http://192.168.1.76/tutor/web/mantis/public_html/view.php?id=37

in methodifier, portion of depends on non-composer class.

ID field missing full name in CS.DTO:
	public string ID { get; set; }

Faker database for all tables.

add, edit, list, flag orm: pass $parameter.
Move emails/ into templates API, separate project

Featured test does not need API, phpunit test case only
DTO name to support multi words
Common output folder from all write template calls

Register role, method to the database at the time of generation
Generate test units inside proper namespace
Break into packages, modules, functions for Unit Tests

Buzz words
	Access control list
	Permissions
	Login

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
