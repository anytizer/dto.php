<?php
namespace structures;

/**
 * Class field - Rendered as PDO Object
 *
 * @package generators
 */
class field
{
	/**
	 * @var string Table name
	 */
	public $TABLE_NAME;

	/**
	 * @var string Storage engine type
	 */
	public $ENGINE;

	/**
	 * @var string Collation type
	 */
	public $TABLE_COLLATION;
}
