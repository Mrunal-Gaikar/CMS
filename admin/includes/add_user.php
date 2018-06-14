<?php

if(isset($_POST['create_user'])){
   
   
    $user_name=$_POST['user_name'];
    echo $user_name." ";
    $user_password=$_POST['user_password'];
    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $user_email=$_POST['user_email'];
//    $user_image=$_POST['user_image'];
    $user_role=$_POST['user_role'];
   
   // $user_date=date('d-m-y');
    //move_uploaded_file($post_image_temp,"../images/$post_image"); 
    $query="insert into users(user_name,user_password,user_firstname,user_lastname,user_email,user_role)";
    $query.="values('{$user_name}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}')";

   $querywork=mysqli_query($conn,$query);
if($querywork)
        echo "<script>alert('User added Successfully!!');</script>";
    else
        die("Couldn't add".mysqli_error($conn));
    echo "User Created:"."<a href='users.php'>View Users</a>";
}
?>   
   
   
   
   <form action="" method="post" enctype="multipart/form-data">
   
   <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
     <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    
    <div class="form-group">
        <select name="user_role" id="" >
            <option value="subscriber">Select options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
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
        <input type="text" class="form-control" name="user_name">
    </div>
    <div class="form-group">
        <label for="username">E-mail</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
   <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
       </div>
       
  
</form>