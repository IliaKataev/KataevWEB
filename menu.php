<?php

include "database.php";

$sections = getSections($db);

$menu = json_encode($sections, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

function getSections($db)
{
    $res = mysqli_query($db, "SELECT * FROM sections");

    $items = [];
    foreach ($res as $row) {
        $row["children"] = [];
        $items[] = $row;
    }

    $sections = [];
    foreach ($items as $item) {
        if ($item["parent_id"] === null) {
            $sections[] = buildChildren($item, $items);
        }
    }

    return $sections;
}

function buildChildren($parent, $items)
{
    foreach ($items as $item) {
        if ($item["parent_id"] == $parent["id"]) {
            $parent["children"][] = buildChildren($item, $items);
        }
    }
    return $parent;
}

?>