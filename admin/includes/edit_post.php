<?php
if(isset($_GET['p_id'])){
    $p_id=$_GET['p_id'];

$query="Select * from post where post_id=$p_id";
$select_post_byid=mysqli_query($conn,$query);

while($row=mysqli_fetch_assoc($select_post_byid)){
    $post_id=$row['post_id'];
    $post_author=$row['post_author'];
    $post_title=$row['post_title'];
    $post_category_id=$row['post_category_id'];
    $post_status=$row['post_status'];
    $post_image=$row['post_image'];
    $post_tags=$row['post_tags'];
    $post_comment_count=$row['post_comment_count'];
    $post_date=$row['post_date'];
    $post_content=$row['post_content'];
   
}
if(isset($_POST['update_post'])){
    $post_title=$_POST['title'];
    $post_title=mysqli_real_escape_string($conn,$post_title);
    $post_author=$_POST['author'];
    $post_category_id=$_POST['post_category'];
    
   
    $post_status=$_POST['post_status'];
    $post_image=$_FILES['image']['name'];
    $post_image_temp=$_FILES['image']['tmp_name'];
    $post_tags=$_POST['post_tags'];
    $post_content=$_POST['post_content'];
    $post_content=mysqli_real_escape_string($conn,$post_content);
    $post_comment_count=0;
    $post_date=date('d-m-y');
    move_uploaded_file($post_image_temp,"../images/$post_image"); //(file,new location)
    if(empty($post_image)){
        $query="select * from post where post_id=$p_id";
        $select_image=mysqli_query($conn,$query);
        while($row=mysqli_fetch_array($select_image))
        {
            $post_image=$row['post_image'];
        }
    }
    
    $query="update post set ";
    $query.="post_category_id='{$post_category_id}',";
    $query.="post_title='{$post_title}',";
    $query.="post_author='{$post_author}',";
     $query.="post_date=now(),";
    $query.="post_image='{$post_image}',";  
     $query.="post_content='{$post_content}',";
     $query.="post_tags='{$post_tags}',";
   // $query.="post_comment_count='{$post_comment_count}',";  
    
    $query.="post_status='{$post_status}'"; 
    
    $query.="where post_id={$p_id}";
    $update_post=mysqli_query($conn,$query);
   if($update_post)
        echo "<script>alert('Post edited Successfully!!');</script>";
    else
        die("Couldn't edit".mysqli_error($conn));
   }
    
}

?>            
             
               <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title;?>" type ="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <select name="post_category" id="">
            <?php
             $query="select * from categories ";

            $select=mysqli_query($conn,$query);
            confirm($select);
           while($row=mysqli_fetch_assoc($select))
           {
           $cat_title=$row['cat_title'];
           $cat_id=$row['cat_id'];
           echo "<option value='$cat_id'>{$cat_title}</option>"; 
               
           }

            ?>
        </select>
    </div>
    
     <div class="form-group">
        <label for="author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
    </div>
     <div class="form-group">
        <label for="status">Post Status</label>
        <input value="<?php echo $post_status; ?>"type="text" class="form-control" name="post_status">
    </div>
     <div class="form-group">
        <label for="post_image">Post Image</label>
        <img class="img-responsive" width="100" src="../images/<?php echo $post_image;?>" alt="">
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>"type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10">
        <?php echo $post_content; ?>
        </textarea>
    </div>
    <div class="form-group">
   <input value="Edit Post" class="btn btn-primary" type="submit" name="update_post" value="Publish Post">
       </div>
         
</form>