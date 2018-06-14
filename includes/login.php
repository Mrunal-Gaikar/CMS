<?php include "db.php" ; ?>
<?php session_start(); ?>
<?php
if(isset($_POST['login'])){
    
  $username= $_POST['username'];
  $password= $_POST['password'];   
    
   $username=mysqli_real_escape_string($conn,$username);
    $password=mysqli_real_escape_string($conn,$password);
    $query="select * from users where user_name='{$username}' ";
    $select=mysqli_query($conn,$query);
    if(!$select){
        die("Query Failed!".mysqli_error($conn));
    }
    
    while($row=mysqli_fetch_array($select))
                        {
                        
                        $db_id=$row['user_id'];
                        $user_name=$row['user_name'];
                        $user_password=$row['user_password'];
                        $user_firstname=$row['user_firstname'];
                        $user_lastname=$row['user_lastname'];
                        $user_email=$row['user_email'];
                        $user_image=$row['user_image'];
                        $user_role=$row['user_role'];
  
        
                        }

    if(($username!== $user_name) || ($password!==$user_password)){
        header("Location:../index.php");
    }
    else if(($username===$user_name) && ($password===$user_password)){
        
         $_SESSION['username']=$user_name;
         $_SESSION['firstname']=$user_firstname;
         $_SESSION['lastname']=$user_lastname;
         $_SESSION['user_role']=$user_role;
         
        
         header("Location:../admin");    }
    
}
?>