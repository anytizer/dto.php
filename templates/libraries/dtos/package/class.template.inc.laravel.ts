<?php
amespace #__PACKAGE_NAME__\models;

use Illuminate\Database\Eloquent\Model;

class #__MODEL_NAME__ extends CustomEloquentModel
{
    protected $table = "#__TABLE_NAME__";
    protected $primaryKey = "#__PRIMARY_KEY__";

    protected $fillable = [
        #__FILLABLE_COLUMNS__
    ];

    protected $guarded = [
        #__GUARDED_COLUMNS__
    ];
}
