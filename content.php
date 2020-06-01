<?php
    $is_admin_panel = false;
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

?>

<div class="container context-menu">
    <div class="col-10 offset-1">
        <div class="nav-link-tag">
            <a href="<?php echo $redirect_url; ?>">Home</a>
            &nbsp;>&nbsp;
            <a href="<?php echo $redirect_url; ?>context.php?cat_id=<?php echo $page_content[0]['cat_id']; ?>" class="">Context</a>
        </div>
        <div class="content-header">
            <hr>
            <div>
                <span class="title_content"><?php echo $page_content[0]['title']; ?></span>
            </div>
            <div class="uploaded_by">
                <div><img src="./public/images/LOGO.png" alt="no-img"></div>
                <div class="user_details">Harish<br><?php echo $page_content[0]['date_value']; ?></div>
            </div>
            <hr>
        </div>
        <div class="content-block">
            <?php echo $page_content[0]['content']; ?>
        </div>
        <div class="uploaded_by">
            <div class="uploaded_date"><br>Reedited by</div>
            <div><img src="./public/images/LOGO.png" alt="no-img"></div>
            <div class="user_details">Harish<br><?php echo $page_content[0]['date_value']; ?></div>
        </div>
        <hr>
        <div class="content-block">
            <h5>Report mistakes and provide corrections:</h5>
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
    </div>

    <hr>
    <h3 class="related_topic">Related</h3>
    <section class="customer-logos slider">
        <?php foreach($related_content as $row) { ?>
        <div class="slide" onclick="location.href='<?php echo $redirect_url; ?>content.php?id=<?php echo $row['id']; ?> '">
            <div class="related_card">
                <div class="related_card_body">
                    <div class="related_card_content">
                        <h3 class="related_card_title">
                            <?php echo $row['title']; ?>
                        </h3>
                        <p>
                            <?php echo $row['one_line_description']; ?>
                        </p>
                    </div>
                    <div class="uploaded_by">
                        <!-- <div class="uploaded_date"><br>Posted By</div> -->
                        <div><img src="./public/images/LOGO.png" alt="no-img"></div>
                        <div class="user_details">Harish<br><?php echo $row['date_value']; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </section>
</div>

<?php 
    include 'footer.php';
?>