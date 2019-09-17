<?php
namespace #__PACKAGE_NAME__\models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "localhost",
    "database" => "inventory",
    "username" => "root",
    "password" => ""
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

/**
 * @see https://laravel.com/docs/6.x/eloquent-mutators
 * @see https://laravel.com/docs/master/eloquent-serialization
 */
abstract class CustomEloquentModel extends Model
{
    protected $table = null;
    protected $primaryKey = null;
    protected $keyType = "string";
    public $incrementing = false;

    public $timestamps = false;
    protected $dateFormat = "Y-m-d H:i:s";
    protected $dates = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];
    const CREATED_AT = "created_on";
    const UPDATED_AT = "modified_on";
}
