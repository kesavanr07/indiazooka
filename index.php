<?php
    $home_page = true;
    
    include 'db_mysql.php';
    include 'header.php';
    $latest_updates    = [];
    $sql               = "SELECT id,title, one_line_description, DATE_FORMAT(created_date, '%d-%b-%Y %h:%i %p') as date_value FROM pagecontent WHERE trending = '1' ORDER BY created_date DESC";
    $response          = $conn->query($sql);

    if(!$response) {
        echo "Empty Recent update data";
    } else if($response->num_rows > 0) {
        foreach($response as $row) {
            array_push($latest_updates, $row);
        }
    }

    $last_updates    = [];
    $sql               = "SELECT id,title, one_line_description, DATE_FORMAT(created_date, '%d-%b-%Y %h:%i %p') as date_value FROM pagecontent  WHERE home = '1' ORDER BY created_date DESC LIMIT 0,7";
    $response          = $conn->query($sql);
    
    if(!$response) {
        echo "Empty last update data";
    } else if($response->num_rows > 0) {
        foreach($response as $row) {
            array_push($last_updates, $row);
        }
    }

?>
<div class="container">
    <div class="col-10 offset-1">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <br>
                <div class="list-group">
                    <?php foreach($last_updates as $row) { ?>
                        <div 
                            onclick="location.href='<?php echo $redirect_url; ?>content.php?id=<?php echo $row['id']; ?>';" 
                            class="list-group-item list-group-item-action"
                        >
                            <div class="title_font"><?php echo $row['title']; ?></div>
                            <div class="list_content">
                                <p><?php echo $row['one_line_description']; ?></p>
                                <p class="read_more">Read More</p>
                                <div class="uploaded_by">
                                    <div><img src="./public/images/LOGO.png" alt="no-img"></div>
                                    <div class="user_details small_font">Harish<br><?php echo $row['date_value']; ?></div>
                                </div>
                            </div>                
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-trending" role="tabpanel" aria-labelledby="nav-profile-tab">
                <br>
                <div class="list-group">
                    <?php foreach($latest_updates as $row) { ?>
                        <div 
                            onclick="location.href='<?php echo $redirect_url; ?>content.php?id=<?php echo $row['id']; ?>';" 
                            class="list-group-item list-group-item-action"
                        >
                            <div class="title_font"><?php echo $row['title']; ?></div>
                            <div class="list_content">
                                <p><?php echo $row['one_line_description']; ?></p>
                                <p class="read_more">Read More</p>
                                <div class="uploaded_by">
                                    <div><img src="./public/images/LOGO.png" alt="no-img"></div>
                                    <div class="user_details small_font">Harish<br><?php echo $row['date_value']; ?></div>
                                </div>
                            </div>                
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <br>
                <?php if(1 == 2) {?>
                    <form>
                        <div class="input-group mb-3">
                            <textarea class="form-control" id="feedback" rows="9"></textarea>
                        </div>
                        <div>
                            <button type="reset" class="btn btn-default nav-button">Cancel</button>
                            <button type="button" class="btn nav-button-blue pull-right">Save</button>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class="alert my_alert text-center" role="alert">
                        Building in Progress...
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php 
include 'footer.php';
?>