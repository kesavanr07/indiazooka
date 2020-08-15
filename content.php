<?php
    $home_page = false;

    include 'db_mysql.php';
    include 'header.php';
    
    $url_components = parse_url($_SERVER['REQUEST_URI']); 
  
    parse_str($url_components['query'], $params); 
    
    $page_content           = [];
    $sql                    = "SELECT *,DATE_FORMAT(created_date, '%d %b %Y %h:%i %p') as date_value FROM pagecontent WHERE id = ".$params['id'];
    $page_content_result    = $conn->query($sql);

    if($page_content_result->num_rows > 0) {
        foreach($page_content_result as $row) {
            array_push($page_content, $row);
        }
    }

    $related_content        = [];
    $error_msg              = "";
    $sql                    = "SELECT id, title, one_line_description, content, DATE_FORMAT(created_date, '%d-%b-%Y %h:%i %p') as date_value FROM pagecontent WHERE id != ".$page_content[0]['id']." AND cat_id = ".$page_content[0]['cat_id'];
    $related_content_result = $conn->query($sql);

    if($related_content_result->num_rows > 0) {
        foreach($related_content_result as $row) {
            array_push($related_content, $row);
        }
    } else {
        $error_msg = "Empty Data found";
    }

    
    $breadcrum              = [];
    if($page_content && $page_content[0] && $page_content[0]['cat_id']) {
        $sql                    = "SELECT * FROM categories WHERE id = ".$page_content[0]['cat_id']." OR id =(SELECT parent_id FROM categories WHERE id = ".$page_content[0]['cat_id'].") ORDER BY parent_id ASC";
        $breadcrum_result    = $conn->query($sql);
    
        if($breadcrum_result->num_rows > 0) {
            foreach($breadcrum_result as $row) {
                array_push($breadcrum, $row);
            }
        }
    }

?>

<div class="container context-menu">
    <div class="col-10 offset-1">
        <div class="nav-link-tag">
            <ol class="breadcrumb title_font_res">
                <li class="breadcrumb-item"><a href="<?php echo $redirect_url; ?>">Home</a></li>
                <?php foreach($breadcrum as $row) { ?>
                    <li class="breadcrumb-item <?php if($row['parent_id'] != '0') { echo ""; } ?>">
                        <a href='<?php echo $redirect_url."context.php?cat_id=".$page_content[0]['cat_id']; ?>'>
                            <?php echo strtolower($row['category_name']); ?>
                        </a>
                    </li>
                <?php } ?>
                &nbsp;<span class="breadcrumb-text"></span>
                <span class="breadcrumb-text"></span>
            </ol>
        </div>
        <div class="content-header">
            <hr>
            <div>
                <span class="title_font"><?php echo $page_content[0]['title']; ?></span>
            </div>
            <div class="uploaded_by">
                <div><img src="./public/images/LOGO.png" alt="no-img"></div>
                <div class="user_details small_font">Harish<br><?php echo $page_content[0]['date_value']; ?></div>
            </div>
            <hr>
        </div>
        <div class="content-block">
            <?php echo $page_content[0]['content']; ?>
        </div>

        <?php if(1 == 2) {?>
            <div class="uploaded_by">
                <div class="uploaded_date"><br>Reedited by</div>
                <div><img src="./public/images/LOGO.png" alt="no-img"></div>
                <div class="user_details small_font">Harish<br><?php //echo $page_content[0]['date_value']; ?></div>
            </div>
            <hr>
            <div class="content-block">
                <div class="title_bar">Report mistakes and provide corrections</div>
                <form>
                    <div class="input-group mb-3">
                        <textarea class="form-control" id="feedback" rows="5"></textarea>
                    </div>
                    <div>
                        <button type="reset" class="btn btn-default nav-button">Cancel</button>
                        <button type="button" class="btn nav-button-blue pull-right">Save</button>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>

    <?php if($related_content) { ?>
    <hr>
    <div class="title_bar related">Related</div>
    <section class="customer-logos slider">
        <?php foreach($related_content as $row) { ?>
        <div class="slide" onclick="location.href='<?php echo $redirect_url; ?>content.php?id=<?php echo $row['id']; ?> '">
            <div class="related_card">
                <div class="related_card_body">
                    <div class="related_card_content">
                        <div class="related_card_title title_font">
                            <?php echo $row['title']; ?>
                        </div>
                        <p>
                            <?php echo $row['one_line_description']; ?>
                        </p>
                    </div>
                    <div class="uploaded_by">
                        <div><img src="./public/images/LOGO.png" alt="no-img"></div>
                        <div class="user_details small_font">Harish<br><?php echo $row['date_value']; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </section>
    <?php } ?>
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