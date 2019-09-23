<?php
namespace #__PACKAGE_NAME__\models;

use anytizer\sanitize;
use anytizer\guid;
use system\abstracts\model_abstracts;
use \PDO;

/**
 * Model for access by controller: #__CLASS_NAME__
 */
class model_#__CLASS_NAME__ extends model_abstracts
{

    /**
     * List
     *
     * @param $data
     * @return array
     */
    public function list($data=[]): array
    {
        $list_sql = "SELECT #__LIST_COLUMN_HEADS__ FROM `#__TABLE_NAME__` WHERE is_active=:is_active ORDER BY added_on DESC LIMIT 1000;";
        $params = [
            "is_active" => "Y",
        ];
        $result = $this->rows($list_sql, $params);
        return $result;
    }


    /**
     * Details
     *
     * @param $data
     * @return array
     */
    public function details($data=[]): array
    {
        $details_sql = "SELECT * FROM `#__TABLE_NAME__` WHERE `#__PRIMARY_KEY__`=:#__PRIMARY_KEY__ LIMIT 1;";
        $params = [
            "#__PRIMARY_KEY__" => $data["#__PRIMARY_KEY__"],
        ];
        $row = $this->single($details_sql, $params);
        return $row;
    }


    /**
     * Soft Delete
     * @todo Return success class instead of php array.
     *
     * @param $data
     * @return array
     */
    public function delete($data=[]): array
    {
        $delete_sql = "UPDATE `#__TABLE_NAME__` SET is_active=:is_active WHERE `#__PRIMARY_KEY__`=:#__PRIMARY_KEY__ LIMIT 1;";
        $params = [
            "is_active" => "N",
            "#__PRIMARY_KEY__" => $data["#__PRIMARY_KEY__"],
        ];
        $success = $this->query($delete_sql, $params);
        return ["success" => $success];
    }


    /**
     * Flag
     * @todo Flag column should be is_flagged, not is_approved
     * @param $data
     * @return array
     */
    public function flag($data=[]): array
    {
        $flag_sql = "UPDATE `#__TABLE_NAME__` SET is_approved=IF(is_approved='Y', 'N', 'Y') WHERE `#__PRIMARY_KEY__`=:#__PRIMARY_KEY__ LIMIT 1;";
        $params = [
            "#__PRIMARY_KEY__" => $data["#__PRIMARY_KEY__"],
        ];
        $success = $this->query($flag_sql, $params);
        return ["success" => $success];
    }


    /**
     * Edit #__TABLE_NAME__ by: #__PRIMARY_KEY__
     * @param $data
     * @return array
     *
     * @todo Sanitize the data properly.
     * @see https://github.com/anytizer/anytizer.php
     */
    public function edit($data=[]): array
    {
        $edit_sql = "UPDATE `#__TABLE_NAME__` SET
            #__KEYVALUE_PAIR__
        WHERE `#__PRIMARY_KEY__`=:#__PRIMARY_KEY__ LIMIT 1;";
        $params = [
            #__PARAMS__,

            "#__PRIMARY_KEY__" => $data["#__PRIMARY_KEY__"],
        ];
        $success = $this->query($edit_sql, $params);
        return ["success" => $success];
    }


    /**
     * Add #__TABLE_NAME__ by: #__PRIMARY_KEY__
     * @param $data
     * @return array
     *
     * @see https://github.com/anytizer/guid.php
     */
    public function add($data=[]): array
    {
        $add_sql = "
INSERT INTO `#__TABLE_NAME__` (
    #__INSERTS_COLUMNS__
) VALUES (
    #__INSERTS_VALUES__
);";
        $params = [
            "#__PRIMARY_KEY__" => (new Guid())->NewGuid(),

            #__INSERTS_PARAMS__,
         ];
        $success = $this->query($add_sql, $params);
        return ["success" => $success];
    }


    #__PUBLIC_METHODS__
}
