<?php
    include '../db_mysql.php';
    include 'header.php';

    $page    = "";
    if($_GET && isset($_GET['page'])) {
        $page = $_GET['page'];
    }
?>
    <div class="col admin_panel">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="<?php echo $redirect_url."admin/index.php"; ?>">
                Admin
            </a>
        </nav>
        <div class="row">
            <?php 
                include 'left_panel.php';

                if($page === 'content') {
                    include 'manage_content.php';
                } else {
                    include 'home.php';
                }
            ?>
        </div>
    </div>
<?php 
    include 'footer.php';
?>