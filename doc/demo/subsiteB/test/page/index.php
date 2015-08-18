<?php

$posts = array(
    array(
        "title" => "post 1",
        "link" => "/post/id/1",
        "content" => "content 1"
    ),
    array(
        "title" => "post 2",
        "link" => "/post/id/2",
        "content" => "content 2"
    ),
    array(
        "title" => "post 3",
        "link" => "/post/id/3",
        "content" => "content 3"
    )
);

$id = is_numeric($_GET['id']) ? intval($_GET['id']) - 1 : 0;

// 给变量 $fis_data 赋值即可
$fis_data = array(
    "site" => array(
        "title" => "fis3-smarty demo"
    ),
    "data" => array(
        "post" => isset($posts[$id]) ? $posts[$id] : $posts[0]
    )
);