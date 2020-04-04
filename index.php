<?php

    include 'db_mysql.php';
    include 'header.php';
    $latest_updates    = [];
    $sql               = "SELECT * FROM pagecontent WHERE recent_updates = '1'";
    $response          = $conn->query($sql);

    if($response->num_rows > 0) {
        foreach($response as $row) {
            array_push($latest_updates, $row);
        }
    }

    $last_updates    = [];
    $sql               = "SELECT id,title FROM pagecontent ORDER BY created_date DESC LIMIT 0,7";
    $response          = $conn->query($sql);
    
    if($response->num_rows > 0) {
        foreach($response as $row) {
            array_push($last_updates, $row);
        }
    }

?>
<div class="container">
    <div class="col">
        <div class="h4 align-h-tag">
            <b>LATEST</b>
        </div>
        <div class="container-fluid content-block">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                        $index = 0; 
                        foreach($latest_updates as $row) { 
                    ?>
                    <div class="carousel-item <?php if($index == 0) { echo 'active'; } ?>" onclick="location.href='/blog_app/content.php?id=<?php echo $row['id']; ?> '">
                        <h3> <?php echo $row['title']; ?> </h3>
                        <br/>
                        <p>
                            <?php echo substr($row['content'], 0, 300).'...'; ?>
                        </p>
                    </div>
                    <?php 
                            $index++;
                        } 
                    ?>
                </div>
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <!-- </div> -->
                <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a> -->
            </div>
        </div>
        <div class="h4 align-h-tag">
            <b>LAST UPDATES</b>
        </div>
        <div class="content-block">
            <?php foreach($last_updates as $row) { ?>
            <div class="card">
                <div class="card-body" onclick="location.href='/blog_app/content.php?id=<?php echo $row['id']; ?>'">
                    <?php echo $row['title']; ?> <i>>></i>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="h4 align-h-tag">
            <b>POST FEEDBACK</b>
        </div>
        <div class="content-block">
            <form>
                <label><b>Email ID</b></label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="email_id">
                </div>
                <label><b>FeedBack</b></label>
                <div class="input-group mb-3">
                    <textarea class="form-control" id="feedback" rows="5"></textarea>
                </div>
                <div>
                    <button type="reset" class="btn btn-default nav-button">Cancel</button>
                    <button type="button" class="btn btn-success nav-button-blue pull-right">Save</button>
                </div>
            </form>
        </div>
        <!-- <div class="row text-center flip-content">
            <div class="col">
                <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                    <h2>TRIBAL AND PEASENT REVOLTS</h2>
                    </div>
                    <div class="flip-card-back">
                    After British made money from war,they can’t get their hands
                    on any teasuries as there were no more. So they adopted the
                    policy of territory expansion. The earsly response against
                    were in two forms one is restorative in nature around the
                    beginning of 18th and 19th century Nationalism that emphasized
                    the consiousness of unity and national aspiration
                    </div>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                    <h2>TRIBAL AND PEASENT REVOLTS</h2>
                    </div>
                    <div class="flip-card-back">
                    After British made money from war,they can’t get their hands
                    on any teasuries as there were no more. So they adopted the
                    policy of territory expansion. The earsly response against
                    were in two forms one is restorative in nature around the
                    beginning of 18th and 19th century Nationalism that emphasized
                    the consiousness of unity and national aspiration
                    </div>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                    <h2>TRIBAL AND PEASENT REVOLTS</h2>
                    </div>
                    <div class="flip-card-back">
                    After British made money from war,they can’t get their hands
                    on any teasuries as there were no more. So they adopted the
                    policy of territory expansion. The earsly response against
                    were in two forms one is restorative in nature around the
                    beginning of 18th and 19th century Nationalism that emphasized
                    the consiousness of unity and national aspiration
                    </div>
                </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
<?php 
include 'footer.php';
?>