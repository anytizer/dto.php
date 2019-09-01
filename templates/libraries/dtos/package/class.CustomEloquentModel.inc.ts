<?php
namespace dtos\#__PACKAGE_NAME__;

use Illuminate\Database\Eloquent\Model;

abstract #__DTO_NAME__ extends CustomEloquentModel
{
    protected $incrementing = false;
    protected $keyType = "string";
    protected $dateFormat = "Y-m-d H:i:s";

    public $timestamps = false;
    protected $dates = ["deleted_at"];
    const CREATED_AT = "created_on";
    const UPDATED_AT = "modified_on";
}
