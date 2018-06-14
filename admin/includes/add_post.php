<?php

if(isset($_POST['create_post'])){
   
    
     $post_title=$_POST['title'];
    $post_author=$_POST['author'];
    $post_category_id=$_POST['post_category'];
    $post_status=$_POST['post_status'];
    $post_image=$_FILES['image']['name'];
    $post_image_temp=$_FILES['image']['tmp_name'];
    $post_tags=$_POST['post_tags'];
    $post_content=$_POST['post_content'];
   // $post_comment_count=0;
    $post_date=date('d-m-y');
    move_uploaded_file($post_image_temp,"../images/$post_image");
    $post_content=mysqli_real_escape_string($conn,$post_content);
    
    $query="insert into post(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status)";
    $query.="values({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

   $querywork=mysqli_query($conn,$query);
if($querywork)
        echo "<script>alert('Post added Successfully!!');</script>";
    else
        die("Couldn't add".mysqli_error($conn));

}
?>   
   
   
   
   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
       
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
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
        <input type="text" class="form-control" name="author">
    </div>
     <div class="form-group">
        <label for="status">Post Status</label>
<!--        <input type="text" class="form-control" name="post_status">-->
        <select name="post_status" id="">
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>
     <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="20">
        </textarea>
    </div>
    <div class="form-group">
   <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
       </div>
       
  
</form>