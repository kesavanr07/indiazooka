<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    if($_SERVER['SERVER_NAME'] === 'localhost') {
        $redirect_url = "/blog_app/";
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
            if($main_row['id'] !== '4' && $main_row['id'] !== '33') {
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
        <link rel="icon" href="./public/images/favicon.jpg" type="image/jpg" sizes="16x16">
        <link rel="stylesheet" href="./public/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./public/css/myfont.css" />
        <link rel="stylesheet" href="./public/css/homepage.css" />
        <link rel="stylesheet" href="./public/css/slick.css" />
    </head>
    <body>
        <div>
            <div class="header">
                <div class="container">
                    <nav class="navbar navbar-light bg-light justify-content-between">
                        <a class="navbar-brand" href="<?php echo $redirect_url; ?>">
                            <img src="./public/images/indiazooka_logo.png" class="img-responsive" width="190px">
                        </a>
                        <div class="res-menu">
                            <i class="fa fa-bars toggle_menu active"></i>
                            <i class="fa fa-times toggle_menu"></i>
                        </div>
                        <?php if($home_page == true) {?>
                        <div class="row home_menu title_font_res">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                                    Home
                                </a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-trending" role="tab" aria-controls="nav-profile" aria-selected="false">
                                    Trending
                                </a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
                                    Share your Knowledge
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </nav>
                </div>
            </div>
            <div class="links">
                <div>
                    <nav class="navbar navbar-expand-sm">
                        <ul class="navbar-nav">
                            <?php foreach($categories_data as $data) { ?>
                            <li class="nav-item dropdown title_font_res">
                                <a
                                    class="nav-link text-uppercase <?php if(sizeof($data['sub_categories']) === 0) { echo "remove-arrow"; } else { echo "dropdown-toggle"; }?>"
                                    href="<?php echo $redirect_url; ?>context.php?cat_id=<?php echo $data["id"]; ?>"
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
                                <div class="dropdown-menu dropright title_font_res" aria-labelledby="navbarDropdownMenuLink">
                                    <?php foreach($data['sub_categories'] as $sub_data) { ?>
                                        <a class="dropdown-item text-uppercase" href="<?php echo $redirect_url; ?>context.php?cat_id=<?php echo $sub_data["id"]; ?>">
                                            <i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;
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

<!-- <div class="input-group">
    <input type="text" class="form-control mr-sm-2" placeholder="Search" aria-label="Search">
    <div class="input-group-append">
        <button type="button" class="btn btn-outline-secondary"><span href="#" class="fa fa-search"></span></button>
    </div>
</div> -->
