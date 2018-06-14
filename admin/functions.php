<?php

function confirm($result){
    
    global $conn;
    if(!$result)
       die("Couldn't add".mysqli_error($conn));
    
}


?>



<?php

function insert_categories(){
global $conn;
                        if(isset($_POST['submit'])){

                        $cat_title=$_POST['cat_title'];
                        if($cat_title==""||empty($cat_title)){
                        echo "This field should not be empty.";

                        }
                    else{
                    $query="insert into categories(cat_title)";
                    $query.="values('{$cat_title}')";
                    $create_category=mysqli_query($conn,$query);

                    if(!$create_category)
                        die("Not added!".mysqli_error($conn));
                    }

                        }
}                      

function findallcategories(){   global $conn;
    
   //find all categories
                                    $query="Select * from categories";
                                    $select=mysqli_query($conn,$query);
    
                                       while($row=mysqli_fetch_assoc($select)){
                                       $cat_title=$row['cat_title'];
                                        $cat_id=$row['cat_id'];
                                       echo "<tr>";
                                        echo "<td>{$cat_id}</td>";
                                       echo "<td>{$cat_title}</td>";
                                       echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
                                       echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
                                       echo "</tr>";
                                   }
                                   
                                
}

function deletecategories(){  global $conn;
                         //Delete Query
                                    if(isset($_GET['delete'])){
                                        $id=$_GET['delete'];
                                        $query="delete from categories where cat_id={$id}";
                                        $del_query=mysqli_query($conn,$query); 
                                        header("Location:categories.php");
                                        
                                    }}
                                    
?>












