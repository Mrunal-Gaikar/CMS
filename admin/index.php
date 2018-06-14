<?php include "includes/header.php"?>
    <div id="wrapper">
      

        <!-- Navigation -->
        
        
        
        <?php include "includes/navigation.php"?>
        
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Welcome to Admin
                          
                            <large><?php echo $_SESSION['username'] ?></large>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->
                
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php
    
    $query="select * from post";
    $select=mysqli_query($conn,$query);
    $post_counts=mysqli_num_rows($select);
?>

                    
                    
                  <div class='huge'><?php  echo $post_counts; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php
    
    $query="select * from comments";
    $select=mysqli_query($conn,$query);
    $comments_count=mysqli_num_rows($select);
?>
                    
                     <div class='huge'><?php echo $comments_count; ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
<?php
    
    $query="select * from users";
    $select=mysqli_query($conn,$query);
    $users_count=mysqli_num_rows($select);
?>
                    <div class='huge'><?php echo $users_count; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                         <div class="col-xs-9 text-right">
                            <?php

                                $query="select * from categories";
                                $select=mysqli_query($conn,$query);
                                $category_count=mysqli_num_rows($select);
                            ?>
                            <div class='huge'><?php echo $category_count; ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->

  <?php
    
    $query="select * from post where post_status='draft'";
    $select_draft=mysqli_query($conn,$query);
    $post_counts_draft=mysqli_num_rows($select_draft);
                
    $query="select * from comments where comment_status='unapproved'";
    $select_unap=mysqli_query($conn,$query);
    $comment_counts_unap=mysqli_num_rows($select_unap);
                
    $query="select * from users where user_role='subscriber'";
    $select_sub=mysqli_query($conn,$query);
    $post_user_sub=mysqli_num_rows($select_sub);
?>

  
  
  
  
  <div class="row">
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            <?php
            
            $element_text=['Active posts','Draft Posts','Comments','Unapproved Comments','Users','Subscribers','Categories'];
            $element_count=[$post_counts,$post_counts_draft,$comments_count,$comment_counts_unap,$users_count,$post_user_sub,$category_count];
            
            for($i=0;$i<7;$i++)
            {
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                
                
             }
            ?>
//          ['Posts', 1000],
          
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
</div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include"includes/footer.php"?>