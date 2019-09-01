<?php
# https://packagist.org/packages/illuminate/

# composer global require illuminate/database
# composer global require illuminate/events
# composer global require illuminate/container

# composer require illuminate/database
# composer require illuminate/events
# composer require illuminate/container

# php.ini: include_paths

require_once("vendor/autoload.php");

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model as Model;

$capsule = new Capsule;

$capsule->addConnection([
    "driver"    => "mysql",
    "host"      => "localhost",
    "database"  => "test",
    "username"  => "root",
    "password"  => "",
    "charset"   => "utf8mb4",
    "collation" => "utf8mb4_general_ci",
    "prefix"    => "",
]);

// Set the event dispatcher used by Eloquent business... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you"ve used setEventDispatcher())
$capsule->bootEloquent();

$users = Capsule::table("users")->where("votes", ">", 100)->get();
$results = Capsule::select("SELECT * FROM users WHERE id = ?", array(1));

// https://laravel.com/docs/5.6/eloquent
class User extends Model {
    protected $table = "users";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $dateFormat = "U";
    const CREATED_AT = "creation_date";
    const UPDATED_AT = "last_update";
    protected $guarded = ["price"];
    // protected $connection = "connection-name";
}

$user = new User;
$user->name = "Test";
$user->votes = 2;
$user->save();

$users = User::where("votes", ">", 1)->get();
print_r($users);

$user = User::find(1);
echo $user->name = "New Flight Name";
$user->save();
$user->delete();

# $deletedRows = App\Flight::where("active", 0)->delete();

#$flight = App\Flight::firstOrCreate(["name" => "Flight 10"]);
#$flight = App\Flight::firstOrNew(["name" => "Flight 10"]);
#$flight = App\Flight::updateOrCreate()
#-- CREATE TABLE users (id INT AUTO_INCREMENT, `name` VARCHAR(255) NOT NULL DEFAULT "", votes INT, PRIMARY KEY(id));
