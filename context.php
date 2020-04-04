<?php

    include 'db_mysql.php';
    include 'header.php';
    
    $url_components = parse_url($_SERVER['REQUEST_URI']); 
  
    // Use parse_str() function to parse the 
    // string passed via URL 
    parse_str($url_components['query'], $params); 
    
    $page_content           = [];
    $error_msg              = "";
    $sql                    = "SELECT id, title FROM pagecontent WHERE cat_id = ".$params['cat_id'];
    $page_content_result    = $conn->query($sql);

    if($page_content_result->num_rows > 0) {
        foreach($page_content_result as $row) {
            array_push($page_content, $row);
        }
    } else {
        $error_msg = "Empty Data found";
    }
?>

<div class="container context-menu">
    <div class="nav-link-tag">
        <a href="/">Home</a>
    </div>
    <div class="">
        <div class="list-group">
            <?php foreach($page_content_result as $row) { ?>
            <a 
                href="/content.php?id=<?php echo $row['id']; ?>" 
                class="list-group-item list-group-item-action text-uppercase"
            >
                <?php echo $row['title']; ?>
            </a>
            <?php } ?>
            <?php if($error_msg != '') { ?>
            <div class="alert alert-primary text-center" role="alert">
                <?php echo $error_msg; ?>
            </div>
            <?php } ?>
        </div>

    </div>
</div>

<?php 
    include 'footer.php';
?>