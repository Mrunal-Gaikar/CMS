<?php include "includes/header.php"?>

<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php   
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
    $query="select * from users where user_name='{$username}'";
    $select=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($select)){
                        $user_id=$row['user_id'];
                        $user_name=$row['user_name'];
                        $user_password=$row['user_password'];
                        $user_firstname=$row['user_firstname'];
                        $user_lastname=$row['user_lastname'];
                        $user_email=$row['user_email'];
                        $user_image=$row['user_image'];
                        $user_role=$row['user_role'];
        
    }
    
    
    
    
?>
   <?php
    
    if(isset($_POST['update_user']))
  {
      
    $user_name=$_POST['user_name'];
    $user_password=$_POST['user_password'];
    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $user_email=$_POST['user_email'];
//    $user_image=$_POST['user_image'];
      $user_role=$_POST['user_role'];
      $query="update users set";
      $query.=" user_name = '{$user_name}',";
      $query.="user_password = '{$user_password}',";
      $query.="user_firstname = '{$user_firstname}',";
      $query.="user_lastname = '{$user_lastname}',";
      $query.="user_email = '{$user_email}',";
      $query.="user_role = '{$user_role}'";
      $query.=" where user_name='{$username}'";
     
  //    echo $query;
      $edit_user_query=mysqli_query($conn,$query);
      if(!$edit_user_query)
          die("couldn't edit".mysqli_error($conn));
  }
      
      
    
    
    ?>
    <div id="wrapper">

        <!-- Navigation -->
        
        
        
        <?php include "includes/navigation.php"?>
        
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                   <form action="" method="post" enctype="multipart/form-data">
   
   <div class="form-group">
        <label for="firstname">First Name</label>
        <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname" >
    </div>
     <div class="form-group">
        <label for="lastname">Last Name</label>
        <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
    </div>
    
    <div class="form-group">
        <select name="user_role" id="" >
          <option value="subscriber"><?php echo $user_role; ?></option>
           <?php
            
            if($user_role=='admin'){
                
            
           echo "<option value='subscriber'>subscriber</option>";                
                
            }
            else
                 echo "<option value='admin'>admin</option>";
            
            ?>
        </select>
    </div>
     
       
<!--
     <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>
-->
    <div class="form-group">
        <label for="username">User Name</label>
        <input value="<?php echo $user_name; ?>" type="text" class="form-control" name="user_name">
    </div>
    <div class="form-group">
        <label for="username">E-mail</label>
        <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
   <input class="btn btn-primary" type="submit" name="update_user" value="Update Profile">
       </div>
       
  
</form>

<?php } ?>
                   
                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include"includes/footer.php"?>
