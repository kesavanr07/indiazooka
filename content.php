<?php

    include 'db_mysql.php';
    include 'header.php';
    
    $url_components = parse_url($_SERVER['REQUEST_URI']); 
  
    // Use parse_str() function to parse the 
    // string passed via URL 
    parse_str($url_components['query'], $params); 
    
    $page_content           = [];
    $sql                    = "SELECT * FROM pagecontent WHERE id = ".$params['id'];
    $page_content_result    = $conn->query($sql);

    if($page_content_result->num_rows > 0) {
        foreach($page_content_result as $row) {
            array_push($page_content, $row);
        }
    }
    
        
    $next_artical   = 0;
    $sql            = "SELECT id FROM pagecontent WHERE cat_id = ".$page_content[0]['cat_id']." AND id > ".$page_content[0]['id']." ORDER BY id LIMIT 1";
    $response       = $conn->query($sql);

    if($response->num_rows > 0) {
        foreach($response as $row) {
            $next_artical= $row['id'];
        }
    }

        
    $prev_artical   = 0;
    $sql            = "SELECT id FROM pagecontent WHERE cat_id = ".$page_content[0]['cat_id']." AND id < ".$page_content[0]['id']." ORDER BY id LIMIT 1";
    $response       = $conn->query($sql);

    if($response->num_rows > 0) {
        foreach($response as $row) {
            $prev_artical= $row['id'];
        }
    }

?>

<div class="container context-menu">
    <div class="nav-link-tag">
    <a href="/">Home</a>
    &nbsp;>&nbsp;
    <a href="/context.php?cat_id=<?php echo $page_content[0]['cat_id']; ?>" class="">Context</a>
    </div>
    <div class="">
        <div class="h5 text-uppercase">
            <b><?php echo $page_content[0]['title']; ?></b>
        </div>
        <div class="content-block">
            <?php echo $page_content[0]['content']; ?>
        </div>
    </div>
    <div class="btm-padding page-nav">
        <?php if($prev_artical > 0) { ?>
        <a href="/content.php?id=<?php echo $prev_artical; ?>" class="btn btn-default nav-button">Previous</a>
        <?php } ?>
        <?php if($next_artical > 0) { ?>
        <a href="/content.php?id=<?php echo $next_artical; ?>" class="btn btn-default nav-button pull-right">Next</a>
        <?php } ?>
    </div>
</div>

<?php 
    include 'footer.php';
?>