<?php
if (is_file("../config/DBClass.php")) {
    require_once("../config/DBClass.php");
} else {
    require_once("../../config/DBClass.php");
}

class  LanguagesCode extends DBClass
{

    private $table = "languages_code";

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
