<?php
namespace #__PACKAGE_NAME__\models;

use system\abstracts\model_abstracts;
use \PDO;

final class #__TABLE_NAME__ extends CustomEloquentModel
{
    public function __construct()
    {
        parent::__construct();

        $this->table = "#__TABLE_NAME__";
        $this->primaryKey = "#__PRIMARY_KEY__";
    }
}

/**
 * // details
 #$ni = ni_items::find(1);
 #echo $ni->toJson();

 // list
 print_r(ni_items::where("item_id", "=", "1")->get()->toArray());
 #$ni = ni_items::where("item_id", "=", "1")->get()->toJson();
 echo $ni;
 */

/**
 * Model for access by controller: #__CLASS_NAME__
 */
class model_#__CLASS_NAME__ extends model_abstracts
{

    /**
     * List
     *
     * @param $data
     */
    public function list($data=array()): array
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
     */
    public function details($data=array()): array
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
     * Delete
     *
     * @param $data
     */
    public function delete($data=array()): array
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
     */
    public function flag($data=array()): array
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
     * Edit
     * @param $data
     */
    public function edit($data=array()): array
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


    #__PUBLIC_METHODS__
}
