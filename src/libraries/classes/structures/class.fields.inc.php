<?php
namespace structures;

/**
 * Class fields - Rendered as PDO Object
 *
 * @package generators
 */
class fields
{
	public $TABLE_NAME;
	public $COLUMN_NAME;
	public $DATA_TYPE;
	public $COLUMN_COMMENT;
	public $COLUMN_DEFAULT;
	public $COLUMN_KEY;

    /**
     * Filled after generating info from the database
     */
	public $COLUMN_DISPLAY;
	public $isLong; // do not appear in listing
	public $isPrivate; // do not appear in anywhere

	// @todo Is Primary Key?
    // @todo Display in list?
    // @todo Display in forms?
}
