<?php 
    if(isset($_GET['p_id'])){
        $the_post_id =$_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id=$the_post_id";
    $select_posts_by_id = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($select_posts_by_id)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
    }

    if(isset($_POST['update_post'])){
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['post_image']['name'];
        $post_image_tmp = $_FILES['post_image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        print_r($post_image);

        move_uploaded_file($post_image_tmp, "../images/{$post_image}");

        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
            $select_image = mysqli_query($connection,$query);

            while($row = mysqli_fetch_array($select_image)){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id ='{$post_category_id}', ";
        $query .= "post_date = now(), ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags  = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = '{$the_post_id}' ";

        $update_post = mysqli_query($connection, $query);
        confirm_Query($update_post);

        header("Location: posts.php");
    }
?>
<form  method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo  $post_title ?>" type="text" name="post_title" class="form-control">    
    </div>

    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <select name="post_category_id" class="form-control">
        <?php 
                $query = "SELECT * FROM categories";
                $select_categories_by_id = mysqli_query($connection, $query);

                confirm_query($select_categories_by_id);

                while($row = mysqli_fetch_assoc($select_categories_by_id)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    
                }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" value="<?php echo  $post_author ?>" class="form-control">    
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" name="post_status" value="<?php echo  $post_status ?>" class="form-control">    
    </div>

    <div class="form-group">
        <img src="../images/<?php echo $post_image ?>" width="100" alt="">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image"  class="form-control">    
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" value="<?php echo  $post_tags ?>" class="form-control">    
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" class="form-control" cols="30" rows="10"><?php echo  $post_content ?></textarea>    
    </div>

    <div class="form-group">
        <input type="submit" name="update_post" class="btn btn-primary" value="Update Post">    
    </div>
</form>