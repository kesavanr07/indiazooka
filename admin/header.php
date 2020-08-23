<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    if($_SERVER['SERVER_NAME'] === 'localhost') {
        $redirect_url = "/indiazooka/";
    } else {
        $redirect_url = '/';
    }
    
    $main_categories    = [];
    $all_sub_categories = [];
    $sql                = "SELECT * FROM categories";
    $response           = $conn->query($sql);

    if($response && $response->num_rows > 0) {
        foreach($response as $row) {
            if($row["parent_id"] == 0) {
                array_push($main_categories, $row);
            } else {
                array_push($all_sub_categories, $row);
            }
        }
        $categories_data = [];
        foreach($main_categories as $main_row) {
            $sub_categories = [];
            foreach($response as $row) {
                if($main_row['id'] == $row['parent_id']) {
                    array_push($sub_categories, $row);         
                }
            }
            $main_row['sub_categories'] =  $sub_categories;
            if($main_row['id'] !== '33') {
                array_push($categories_data, $main_row);
            }
        }
    } else {
        echo "Empty categories data from Table";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>INDIAZOOKA</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="Pragma" content="no-cache" />
        <link rel="icon" href="../public/images/favicon.jpg" type="image/jpg" sizes="16x16">
        <link rel="stylesheet" href="../public/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../public/css/myfont.css" />
    </head>
    <body>