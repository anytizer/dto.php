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
        $sql = "SELECT * FROM `#__TABLE_NAME__` WHERE is_active='Y' LIMIT 1000;";
        $statement = $this->pdo->prepare($sql);
        $params = [];
        $statement->execute($params);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
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
        $sql = "SELECT * FROM `#__TABLE_NAME__` WHERE `#__PRIMARY_KEY__`=:#__PRIMARY_KEY__ LIMIT 1;";
        $statement = $this->pdo->prepare($sql);
        $params = [
            "#__PRIMARY_KEY__" => $data["#__PRIMARY_KEY__"],
        ];
        $statement->execute($params);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    /**
     * Soft Delete
     *
     * @param $data
     * @return array
     */
    public function delete($data=[]): array
    {
        $sql = "UPDATE `#__TABLE_NAME__` SET is_active='N' WHERE `#__PRIMARY_KEY__`=:#__PRIMARY_KEY__ LIMIT 1;";
        $statement = $this->pdo->prepare($sql);
        $params = [
            "#__PRIMARY_KEY__" => $data["#__PRIMARY_KEY__"],
        ];
        $statement->execute($params);
        $success = $statement->execute($params);
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
        $sql = "UPDATE `#__TABLE_NAME__` SET is_approved=IF(is_approved='Y', 'N', 'Y') WHERE `#__PRIMARY_KEY__`=:#__PRIMARY_KEY__ LIMIT 1;";
        $statement = $this->pdo->prepare($sql);
        $params = [
            "#__PRIMARY_KEY__" => $data["#__PRIMARY_KEY__"],
        ];
        $success = $statement->execute($params);
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
        $sql = "UPDATE `#__TABLE_NAME__` SET
            #__KEYVALUE_PAIR__
        WHERE `#__PRIMARY_KEY__`=:#__PRIMARY_KEY__ LIMIT 1;";
        $statement = $this->pdo->prepare($sql);
        $params = [
            #__PARAMS__,

            "#__PRIMARY_KEY__" => $data["#__PRIMARY_KEY__"],
        ];
        $success = $statement->execute($params);
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
        $sql = "
INSERT INTO `#__TABLE_NAME__` (
    #__INSERTS_COLUMNS__
) VALUES (
    #__INSERTS_VALUES__
);";
        $statement = $this->pdo->prepare($sql);
        $params = [
            "#__PRIMARY_KEY__" => (new Guid())->NewGuid(),

            #__INSERTS_PARAMS__,
         ];
        $success = $statement->execute($params);
        return ["success" => $success];
    }


    #__PUBLIC_METHODS__
}
