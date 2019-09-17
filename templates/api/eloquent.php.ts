<?php

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
