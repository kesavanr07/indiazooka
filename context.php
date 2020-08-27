<?php
    $home_page = false;

    include 'db_mysql.php';
    include 'header.php';
    
    $url_components = parse_url($_SERVER['REQUEST_URI']); 
  
    // Use parse_str() function to parse the 
    // string passed via URL 
    parse_str($url_components['query'], $params); 
    
        
    $breadcrum              = [];
    $sql                    = "SELECT * FROM categories WHERE id = ".$params['cat_id']." OR id =(SELECT parent_id FROM categories WHERE id = ".$params['cat_id'].") ORDER BY parent_id ASC";
    $breadcrum_result    = $conn->query($sql);

    if($breadcrum_result->num_rows > 0) {
        foreach($breadcrum_result as $row) {
            array_push($breadcrum, $row);
        }
    }
    
    $page_content           = [];
    $error_msg              = "";
    $sql                    = "SELECT id, title, one_line_description, images, DATE_FORMAT(created_date, '%d-%b-%Y %h:%i %p') as date_value FROM pagecontent WHERE cat_id = ".$params['cat_id'];
    $page_content_result    = $conn->query($sql);

    if($page_content_result->num_rows > 0) {
        foreach($page_content_result as $row) {
            array_push($page_content, $row);
        }
    } else {
        $error_msg = "Your data will update soon...";
    }
    // echo "<pre>";
    // print_r($breadcrum);
    // echo "</pre>";
?>

<div class="container context-menu">
    <div class="col-10 offset-1">
            <div class="nav-link-tag">                
                <ol class="breadcrumb title_font_res">
                    <li class="breadcrumb-item"><a href="<?php echo $redirect_url; ?>">Home</a></li>
                    <?php foreach($breadcrum as $row) { ?>
                        <li class="breadcrumb-item <?php if($row['parent_id'] != '0') { echo "active"; } ?>"  <?php if($row['parent_id'] != '0') { echo 'aria-current="page"'; } ?>>
                            <?php echo strtolower($row['category_name']); ?>
                        </li>
                    <?php } ?>
                </ol>
            </div>
            <div class="list-group">
            <?php foreach($page_content_result as $row) { ?>
            <div 
                onclick="location.href='<?php echo $redirect_url; ?>content.php?id=<?php echo $row['id']; ?>';" 
                class="list-group-item list-group-item-action"
            >
                <?php if(isset($row['images'])) { ?>
                    <div class="banner-img">
                        <img src="./public/images/uploads/<?php echo $row['images']; ?>" class="img-responsive" alt="">
                        <div class="now-added">
                            <?php echo $breadcrum[1]['category_name']; ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!isset($row['images'])) { ?>
                    <div class="title_font"><?php echo $row['title']; ?></div>
                <?php } ?>
                <div class="list_content">
                    <?php if(!isset($row['images'])) { ?>
                        <p><?php echo $row['one_line_description']; ?></p>
                    <?php } ?>
                    <p class="read_more">Read More</p>
                    <div class="uploaded_by">
                        <div><img src="./public/images/LOGO.png" alt="no-img"></div>
                        <div class="user_details small_font">Harish<br><?php echo $page_content[0]['date_value']; ?></div>
                    </div>
                </div>                
            </div>
            <?php } ?>
            <?php if($error_msg != '') { ?>
            <div class="alert my_alert text-center" role="alert">
                <?php echo $error_msg; ?>
            </div>
            <?php } ?>
        </div>

    </div>
</div>
<style>
    .navbar-brand {
        margin-right: 28%;
    }
    .header .fa {
       margin-left: 9px;
    }
</style>
<?php 
    include 'footer.php';
?>