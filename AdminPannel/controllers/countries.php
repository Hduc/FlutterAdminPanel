<?php
if (is_file("../config/DBClass.php")) {
    require_once("../config/DBClass.php");
} else {
    require_once("../../config/DBClass.php");
}

class Countries extends DBClass
{

    private $table = "countries";

    function getAllQuery($req)
    {
        return $this->query($req);
    }

    function getAll()
    {
        $result =  $this->getAllQuery("SELECT * FROM $this->table");
        return $result;
    }
}
