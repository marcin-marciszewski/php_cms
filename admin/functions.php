<?php 

function confirm_query($result){
    global $connection;

    if(!$result){
        die("Query Failed" . mysqli_error($connection));
    }
}

function insert_categories(){
    global $connection;

    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if($cat_title == '0'|| empty($cat_title)){
            echo 'This field should not be empty';
        } else {
            $query = "INSERT INTO categories(cat_title)";
            $query .= "VALUE('${cat_title}')";

            $create_category_query = mysqli_query($connection,$query);

            if(!$create_category_query){
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function find_all_categories(){
        global $connection;
        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $query);

        // Find all categories
        while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td><a href='#'>{$cat_id}</a></td>";
        echo "<td><a href='#'>{$cat_title}</a></td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function delete_category(){
    global $connection;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id={$the_cat_id}";
        $delete_query = mysqli_query($connection,$query);
        header("Location: categories.php");
    }
}

function find_all_posts(){
    global $connection;
    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($connection, $query);

    // Find all posts
    while($row = mysqli_fetch_assoc($select_posts)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        echo "<tr>";
        echo "<td>$post_id</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_title</td>";
        echo "<td>$post_category_id</td>";
        echo "<td>$post_status</td>";
        echo "<td><img width=150 src='../images/$post_image'</td>";
        echo "<td>$post_tags</td>";
        echo "<td>$post_comment_count</td>";
        echo "<td>$post_date</td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function delete_post(){
    global $connection;

    if(isset($_GET['delete'])){
       $delete_post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }
}

?>