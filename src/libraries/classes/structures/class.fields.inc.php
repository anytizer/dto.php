<?php

namespace structures;

/**
 * Class fields - To be rendered as PDO Object
 *
 * @package generators
 */
class fields
{
    /**
     * Fields generated from the database properties
     * DO NOT change
     */
    public $TABLE_NAME;
    public $COLUMN_NAME;
    public $DATA_TYPE;
    public $COLUMN_COMMENT;
    public $COLUMN_DEFAULT;
    public $COLUMN_KEY;

    /**
     * Filled after generating info from the database
     */
    public $COLUMN_DISPLAY = "";

    /**
     * @var bool flags
     */
    public $isLong = false; // do not appear in listing, eg. textarea
    public $isPrivate = false; // do not appear in anywhere, PRI, MUL keys
    public $isDate = false;
    public $isFlag = false;
}
