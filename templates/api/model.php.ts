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
        $sql = "SELECT * FROM `#__TABLE_NAME__` LIMIT 1000;";
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


    #__PUBLIC_METHODS__
}
