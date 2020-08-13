<?php

    $page    = "list";
    if($_GET && isset($_GET['id'])) {
        $page = 'manage';
    }
    
    
    $err_msg = "";
    $edit_content        = [];
    $all_contents        = [];

    if($page === 'manage') {
        if($_GET && $_GET['id']) {
            $sql = "SELECT p.*, c.parent_id as category_id FROM pagecontent as p LEFT JOIN categories as c ON(p.cat_id = c.id) WHERE p.id = ".$_GET['id']."";
            $edit_result = $conn->query($sql);
        
            if($edit_result->num_rows > 0) {
                foreach($edit_result as $row) {
                    array_push($edit_content, $row);
                }
            } else {
                $error_msg = "<div class='alert alert-danger text-center'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Empty Data found to edit.
                </div>";
            }
        }
    } else {
        $sql        = "SELECT id, title FROM pagecontent";
        $response   = $conn->query($sql);
        if ($response->num_rows > 0) {
            foreach($response as $row) {
                array_push($all_contents, $row);
            }
        } else {
            $err_msg = "<div class='alert alert-danger text-center'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                No content data found 
            </div>";
        }
    }

    $file_name = isset($_POST['old_image_file']) ? $_POST['old_image_file'] : "" ;

    $errors= "";
    if($_FILES && $_FILES['image_file'] && $_FILES['image_file']['size'] > 0) {
        $file_name = time()."_".$_FILES['image_file']['name'];
        $file_size = $_FILES['image_file']['size'];
        $file_tmp = $_FILES['image_file']['tmp_name'];
        $file_type = $_FILES['image_file']['type'];
        $tmp = explode('.',$_FILES['image_file']['name']);
        $file_ext = strtolower(end($tmp));
        
        $extensions= array("jpeg","jpg","png");
        
        if(in_array($file_ext,$extensions)=== false){
           $errors .= " Extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($file_size > 5097152) {
           $errors .='& File size must be excately 2 MB';
        }
        
        if(empty($errors)==true) {
           move_uploaded_file($file_tmp,"../public/images/uploads/".$file_name);
        }
    }
    // if($_POST) {
    //     echo $file_name; die;
    // }
    if($_POST) {

        if(isset($_POST['id']) && $_POST['id'] != '') {
            $sql = "UPDATE pagecontent SET title = '".$_POST['title']."', one_line_description = '".$_POST['description']."', content='".$_POST['detail_content']."', images='".$file_name."', cat_id='".$_POST['sub_category']."' WHERE id = '".$_POST['id']."'";
        } else {
            $sql = "INSERT INTO pagecontent (title, one_line_description, content, cat_id,images)
            VALUES ('".$_POST['title']."', '".$_POST['description']."', '".$_POST['detail_content']."', '".$_POST['sub_category']."', '".$file_name."')";
        }
        $response = $conn->query($sql);
        if ($response === TRUE) {
            $err_msg = "<div class='alert alert-success text-center'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    Successfully, your data saved in database!.
                </div>";
        } else {
            $err_msg = "<div class='alert alert-danger text-center'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                Some error on saving your data, Try again later. ".$errors."
            </div>";
        }    

    }
    
    
?>

<div class="col-10">
    <?php echo $err_msg; ?>
    <div class="tab-pane fade show active" role="tabpanel">
        <?php if($page === 'manage') { ?>

        <div class="jumbotron">
            <h3>
                <?php if($edit_content) { echo "Edit"; } else { echo "Add"; } ?> Content
            </h3>
            <form method="post" class='<?php if($edit_content) { echo "view_data";} ?>'  enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php if($edit_content) { echo $edit_content[0]['id']; } ?>">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" value="<?php if($edit_content) { echo $edit_content[0]['title']; } ?>" id="title" name="title" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control"  value="<?php if($edit_content) { echo $edit_content[0]['one_line_description']; } ?>" id="description" name="description" placeholder="One line Description">
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category">
                            <?php foreach($categories_data as $data) { ?>
                                <option value="<?php echo $data["id"]; ?>" <?php if($edit_content && $data["id"] == $edit_content[0]['category_id']) { echo 'selected="true"'; }?> >
                                    <?php echo $data["category_name"]; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="sub_category">Sub Category</label>
                        <select class="form-control" id="sub_category" name="sub_category">
                        <?php foreach($all_sub_categories as $data) { ?>
                            <option value="<?php echo $data["id"]; ?>" <?php if($edit_content && $data["id"] == $edit_content[0]['cat_id']) { echo 'selected="true"'; }?> parent-id="<?php echo $data["parent_id"]; ?>" >
                                <?php echo $data["category_name"]; ?>
                            </option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="category">Image Upload</label>
                        <input type="file" class="form-control" id="image_file" name="image_file">
                        <input type="hidden" class="form-control" name="old_image_file" value="<?php if($edit_content) { echo $edit_content[0]['images']; } else { echo ""; } ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail_content">Content</label>
                    <textarea id="detail_content" name="detail_content">
                        <?php if($edit_content) { echo $edit_content[0]['content']; } ?>
                    </textarea>
                </div>
                <a class="btn btn-default" class="btn btn-secondary" href='<?php echo $redirect_url."admin/index.php?page=content"; ?>'>Back</a>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>

        <?php } else { ?>

        <a class="btn btn-primary" href='<?php echo $redirect_url."admin/index.php?page=content&id=0";?> '>
            Add new content
        </a>
        <hr>
        <div class="">
            <table class="table table-dark">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Content Title</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($all_contents as $key=>$value) { ?>
                        <tr>
                            <th scope="row"><?php echo $key+1; ?></th>
                            <td><?php echo $value['title']; ?></td>
                            <td>
                                <a class="btn btn-primary" href='<?php echo $redirect_url."admin/index.php?page=content&id=".$value['id']; ?>'>
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <a type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
        <?php } ?>

    </div>
</div>