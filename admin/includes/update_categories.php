<form  method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>
        <?php 
            if(isset($_GET['edit'])){
                $cat_id = $_GET['edit'];
                $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
                $select_categories = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_categories)){
                    $selected_cat_id = $row['cat_id'];
                    $selected_cat_title = $row['cat_title'];

                    ?><input class="form-control" type="text" name="cat_title" value="<?php if(isset($selected_cat_title)) {echo $selected_cat_title;} ?>"><?php
                }
            }

            // Update query
            if(isset($_POST['update_category'])){
            $the_cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title='{$the_cat_title}' WHERE cat_id={$cat_id}";
            $update_query = mysqli_query($connection,$query);
            header("Location: categories.php");
            }

        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>