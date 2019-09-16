<?php
namespace #__PACKAGE_NAME__\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @see Table #__TABLE_NAME__
 * https://laravel.com/docs/5.8/eloquent
 */
class #__DTO_NAME__ extends Model
{
    use SoftDeletes;

    protected $table = "#__TABLE_NAME__";
    protected $primaryKey = "#__PRIMARY_KEY__";
    protected $incrementing = false;
    protected $keyType = "string";
    protected $dateFormat = "Y-m-d H:i:s";

    protected $fillable = [
        #__FILLABLE_COLUMNS__
    ];

    protected $guarded = [
        #__GUARDED_COLUMNS__
    ];

    public $timestamps = false;
    protected $dates = ["deleted_at"];
    const CREATED_AT = "created_on";
    const UPDATED_AT = "modified_on";
}
