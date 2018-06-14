<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User Name</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
<!--                                    <th>Date</th>-->
                                    
                                </tr>
                            </thead>
                       
                        <tbody>
                           
<?php
$query="Select * from users";
$select_users=mysqli_query($conn,$query);

while($row=mysqli_fetch_assoc($select_users)){
    $user_id=$row['user_id'];
    $user_name=$row['user_name'];
    $user_password=$row['user_password'];
    $user_firstname=$row['user_firstname'];
    $user_lastname=$row['user_lastname'];
    $user_email=$row['user_email'];
    $user_image=$row['user_image'];
    $user_role=$row['user_role'];
  
echo "<tr>";
echo "<td>$user_id</td>";  
echo "<td>$user_name</td>";
echo "<td>$user_firstname</td>";
    
//     $query="select * from comments";
//                                    
//$select_comment=mysqli_query($conn,$query);
//
//while($row=mysqli_fetch_assoc($select_comment))
//{
//            $cat_title=$row['cat_title'];
//          $cat_id=$row['cat_id'];
//    echo "<td>$cat_title</td>";     
//            
//}
                    

echo "<td>$user_lastname</td>";
echo "<td>$user_email</td>";
echo "<td>$user_role</td>";

//    $query="select*from post where post_id=$comment_post_id";
//    $select_title=mysqli_query($conn,$query);
//    if(!$select_title){
//        die("couldn't display title!".mysqli_error());
//    }
//    while($row=mysqli_fetch_assoc($select_title)){
//        $comment_post_title=$row['post_title'];
//    }

echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
echo "<td><a href='users.php?source=edit_user&edit_u=$user_id'>Edit</a></td>";
echo "<td><a href='users.php?delete_user=$user_id'>Delete</a></td>";
echo "</tr>";
}
?>
                        </tbody>
                         </table>
                         
  <?php

if(isset($_GET['change_to_admin'])){
    $user_id=$_GET['change_to_admin'];
    $query="update users set user_role='admin' where user_id=$user_id";
    $approve_query=mysqli_query($conn,$query);
    if(!$approve_query)
        die("Failed!".mysqli_error($conn));
    header("Location:users.php");
}

?>
                         
<?php
if(isset($_GET['change_to_sub'])){
   $user_id=$_GET['change_to_sub'];
    $query="update users set  user_role='subscriber' where user_id=$user_id";
    $unapprove_query=mysqli_query($conn,$query);
    if(!$unapprove_query){
        die("Query Failed! Couldn't Do!".mysqli_error($conn));
    }
    else{
       
     header("Location:users.php");}
    
}

?>
                         
                         
<?php

if(isset($_GET['delete_user'])){
   $user_id=$_GET['delete_user'];
  
    $query="delete from users where user_id={$user_id}";
    $del_query=mysqli_query($conn,$query);
    if(!del_query){
        die("Query Failed! Couldn't Delete!".mysqli_error($conn));
    }
    else{
        
     header("Location:users.php");}
    
}

?>