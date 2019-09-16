<?php
namespace #__PACKAGE_NAME__\models;

use Illuminate\Database\Eloquent\Model;

/**
 * @see https://laravel.com/docs/6.x/eloquent-mutators
 */
abstract CustomEloquentModel
{
    protected $incrementing = false;
    protected $keyType = "string";

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
