<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>                                   
                                    <th>Author</th>                                   
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>                                    
                                    <th>Delete</th>
                                    
                                </tr>
                            </thead>
                       
                        <tbody>
                           
<?php
$query="Select * from comments";
$select=mysqli_query($conn,$query);

while($row=mysqli_fetch_assoc($select)){
    $comment_id=$row['comment_id'];
    $comment_author=$row['comment_author'];
    $comment_email=$row['comment_email'];
    $comment_post_id=$row['comment_post_id'];
    $comment_status=$row['comment_status'];
    $comment_date=$row['comment_date'];
    $comment_content=$row['comment_content'];
    
   
echo "<tr>";
echo "<td>$comment_id</td>";
echo "<td>$comment_author</td>";
echo "<td>$comment_content</td>";
echo "<td>$comment_email</td>";
    
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
                    

echo "<td>$comment_status</td>";
    $query="select*from post where post_id=$comment_post_id";
    $select_title=mysqli_query($conn,$query);
    if(!$select_title){
        die("couldn't display title!".mysqli_error());
    }
    while($row=mysqli_fetch_assoc($select_title)){
        $comment_post_title=$row['post_title'];
    }
echo "<td><a href='../post.php?p_id=$comment_post_id'>$comment_post_title</a></td>";
echo "<td>$comment_date</td>";
echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";

echo "<td><a href='comments.php?delete=$comment_id&cp_id=$comment_post_id'>Delete</a></td>";
echo "</tr>";
}
?>
                        </tbody>
                         </table>
                         
  <?php

if(isset($_GET['approve'])){
    $comment_id=$_GET['approve'];
    $query="update comments set comment_status='Approved' where comment_id=$comment_id";
    $approve_query=mysqli_query($conn,$query);
    if(!$approve_query)
        die("Failed!".mysqli_error($conn));
    header("Location:comments.php");
}

?>
                         
<?php
if(isset($_GET['unapprove'])){
   $comment_id=$_GET['unapprove'];
    $query="update comments set  comment_status='Unapproved' where comment_id=$comment_id ";
    $unapprove_query=mysqli_query($conn,$query);
    if(!$unapprove_query){
        die("Query Failed! Couldn't Do!".mysqli_error($conn));
    }
    else{
       
     header("Location:comments.php");}
    
}

?>
                         
                         
<?php

if(isset($_GET['delete'])){
   $comment_id=$_GET['delete'];
    $comment_post_id=$_GET['cp_id'];
     
                    $query="update post set post_comment_count = post_comment_count-1";
                    $query.=" where post_id=$comment_post_id"; 
                 
                    $update_comment_count=mysqli_query($conn,$query);
                    if(!$update_comment_count)
                        die("error!".mysqli_error($conn));
    $query="delete from comments where comment_id={$comment_id}";
    $del_query=mysqli_query($conn,$query);
    if(!del_query){
        die("Query Failed! Couldn't Delete!".mysqli_error($conn));
    }
    else{
        echo '<script src="text/javascript>alert("Query deleted successfully!");</script>';
     header("Location:comments.php");}
    
}

?>