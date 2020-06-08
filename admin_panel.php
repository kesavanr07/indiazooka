<?php
    $is_admin_panel = true;
    include 'db_mysql.php';
    include 'header.php';
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $err_msg = "";
    if($_POST) {
        ;
        $sql = "INSERT INTO pagecontent (title, one_line_description, content, cat_id)
                VALUES ('".$_POST['title']."', '".$_POST['decription']."', '".$_POST['detail_content']."', '".$_POST['sub_category']."')";
        $response = $conn->query($sql);
        if ($response === TRUE) {
            $err_msg = "<div class='alert alert-success text-center'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Successfully, your data saved in database!.
                </div>";
        } else {
            $err_msg = "<div class='alert alert-danger text-center'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Some error on saving your data, Try again later.
            </div>";
        }
    }
?>
    <div class="col admin_panel">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">
                Admin
            </a>
        </nav>
        <?php echo $err_msg; ?>
        <div class="row">
            <div class="col-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Add Content</a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                </div>
            </div>
            <div class="col-10">
                <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="jumbotron">
                    </div>
                </div>
                <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="jumbotron">
                        <h3>Add Content</h3>
                        <form method="post">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="decription">Description</label>
                                <input type="text" class="form-control" id="decription" name="decription" placeholder="One line Description">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category">
                                        <?php foreach($categories_data as $data) { ?>
                                            <option value="<?php echo $data["id"]; ?>"><?php echo $data["category_name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="sub_category">Sub Category</label>
                                    <select class="form-control" id="sub_category" name="sub_category">
                                    <?php foreach($all_sub_categories as $data) { ?>
                                        <option value="<?php echo $data["id"]; ?>" parent-id="<?php echo $data["parent_id"]; ?>"><?php echo $data["category_name"]; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="detail_content">Content</label>
                                <textarea id="detail_content" name="detail_content"></textarea>
                            </div>
                            <button type="button" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    
                    Eu dolore ea ullamco dolore Lorem id cupidatat excepteur reprehenderit consectetur elit id dolor proident in cupidatat officia. 
                    Voluptate excepteur commodo labore nisi cillum duis aliqua do. Aliqua amet qui mollit consectetur nulla mollit velit 
                    aliqua veniam nisi id do Lorem deserunt amet. Culpa ullamco sit adipisicing labore officia magna elit nisi in aute
                    tempor commodo eiusmod.
                    </div>
                </div>
            </div>
        </div>
    </div>
 <script>
    $(function() {

    });
 </script>
<?php 
    include 'footer.php';
?>