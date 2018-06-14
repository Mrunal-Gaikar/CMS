<?php 
include "includes/header.php";
include "includes/db.php";
?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <?php
            
            if(isset($_GET['p_id'])){
                
               $p_id=$_GET['p_id'];
                
            }?>
            <div class="col-md-8">
               <?php
                $query ="SELECT * FROM post where post_id=$p_id";
                $select=mysqli_query($conn,$query);
                while($row= mysqli_fetch_assoc($select)){
                    $post_title=$row['post_title'];
                    $post_author=$row['post_author'];
                    $post_date=$row['post_date'];
                    $post_image=$row['post_image'];
                    $post_content=$row['post_content'];                   
                    $post_id=$row['post_id'];
                                
                ?>

                <h1 class="page-header">
                    <?php echo $post_title ;?> Post
<!--                    <small>Secondary Text</small>-->
                </h1>
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
<!--                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>-->
                <hr>
              <?php } ?>
<!--              Blog Comments-->
              <?php 
                
                if(isset($_POST['create_comment']))
                {
                            $c_post_id=$_GET['p_id'];               
                            $comment_author=$_POST['comment_author'];
                            $comment_email=$_POST['comment_email'];
                            $comment_content=$_POST['comment_content'];
                    $query="insert into comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)";
                    $query.="values({$c_post_id}, '{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now())";
                    $query_comment=mysqli_query($conn,$query);
                   if(!$query_comment){
                       die("Couldn't add comment!".mysqli_error($conn));
                   }
                   
                    
                    $query="update post set post_comment_count = post_comment_count+1";
                    $query.=" where post_id={$c_post_id}"; 
                 
                    $update_comment_count=mysqli_query($conn,$query);
                    if(!$update_comment_count)
                        die("error!".mysqli_error($conn));
                }             
   
                ?>
              
               <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" id="" action="">
                       <div class="form-group">
                           <label for="author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                           <label for="author">E-mail</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                         
                         <div class="form-group">
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
$query=" Select * from comments where comment_post_id=$post_id ";
                $query.="and comment_status = 'Approved'";
                
                $query.="order by comment_id DESC ";
                $select_comment_query=mysqli_query($conn,$query);
                if(!$select_comment_query){
                    die("Query failed!".mysqli_error($conn));
                }


while($row=mysqli_fetch_assoc($select_comment_query)){
   
    $comment_author=$row['comment_author'];
   
    $comment_date=$row['comment_date'];
    $comment_content=$row['comment_content'];
    
             ?>   
                    

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date ;?></small>
                        </h4>
                        <?php echo $comment_content ;?>
                    </div>
                </div>
                
                
                
        <?php }        ?>
                
                
         

                <!-- Comment -->
               

            </div>

            <!-- Blog Sidebar Widgets Column -->
          <?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->

        <hr>

        <?php   include "includes/footer.php" ?>
