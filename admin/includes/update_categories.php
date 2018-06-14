<form action="" method="post">
                            
                            <div class="form-group">
                               <label for="cat-title">Edit Category</label>
                               
                               <?php
                                
                                if(isset($_GET['edit'])){
                                    $cat_id=$_GET['edit'];
                                    $query="select * from categories where cat_id={$cat_id}";
                                    
                                    $select=mysqli_query($conn,$query);
    
                                       while($row=mysqli_fetch_assoc($select)){
                                       $cat_title=$row['cat_title'];
                                        $cat_id=$row['cat_id'];
                                 ?> 
                                <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>"type="text" class="form-control" name="cat_title"> 
                                 
                                <?php }} ?>
                                      <?php
                                //update query
                                
                                 if(isset($_POST['editsubmit'])){
                                        $cat_title=$_POST['cat_title'];
                                    
                                        $query="update categories set cat_title='{$cat_title}' where cat_id={$cat_id}";
                                        $edit_query=mysqli_query($conn,$query); 
                                     if(!$edit_query){
                                         die("Query failed".mysqli_error($conn));
                                     }
                                        header("Location:categories.php");
                                        
                                    }                                
                                
                                ?>                                      
                                
                         
                            </div>
                             <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="editsubmit" value="Edit Category">
                            </div>
                           
                            
                        </form>