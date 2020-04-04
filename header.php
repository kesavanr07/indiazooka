<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $main_categories    = [];
    $sql                = "SELECT * FROM categories";
    $response           = $conn->query($sql);

    if($response->num_rows > 0) {
        foreach($response as $row) {
            if($row["parent_id"] == 0) {
                array_push($main_categories, $row);
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
            array_push($categories_data, $main_row);
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
        <link rel="stylesheet" href="./public/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cormorant+Garamond">
        <link rel="stylesheet" href="./public/css/homepage.css" />
    </head>
    <body>
        <div>
            <div class="header">
                <div class="container" onclick="location.href='/blog_app/'">
                    <h1>INDIAZOOKA</h1>
                </div>
            </div>
            <div class="links">
                <div class="">
                    <nav class="navbar navbar-expand-sm">
                        <ul class="navbar-nav">
                            <?php foreach($categories_data as $data) { ?>
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link text-uppercase <?php if(sizeof($data['sub_categories']) === 0) { echo "remove-arrow"; } else { echo "dropdown-toggle"; }?>"
                                    href="/blog_app/context.php?cat_id=<?php echo $data["id"]; ?>"
                                    <?php if(sizeof($data['sub_categories']) > 0) { ?>
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    <?php }?>
                                >
                                    <?php echo $data["category_name"]; ?>
                                </a>
                                <?php if(sizeof($data['sub_categories']) > 0) { ?>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <?php foreach($data['sub_categories'] as $sub_data) { ?>
                                        <a class="dropdown-item text-uppercase" href="/blog_app/context.php?cat_id=<?php echo $sub_data["id"]; ?>">
                                            <?php echo $sub_data["category_name"]; ?>
                                        </a>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>