<?php

require_once 'db.php';

$menu = $_POST['menu'];
$array_menu = json_decode($menu, true);

$db->query('TRUNCATE TABLE test');

function updateMenu($menu,$parent = 0)
{
    global $db;

    

    if (!empty($menu)) {
        

        foreach ($menu as $value) {
            
            $label = $value['label'];
            $url = (empty($value['url'])) ? '#' : $value['url'];

            $sql = "INSERT INTO test (label_menu, url_menu, parent_id) VALUES ('$label', '$url', $parent)";

            $db->query($sql);
            $id = $db->insertedId();

            if (array_key_exists('children', $value))
                updateMenu($value['children'],$id);
        }

    }
}


updateMenu($array_menu);

//header("Location: index.php")
