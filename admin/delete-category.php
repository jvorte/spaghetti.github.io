<?php  
                      include('dbconnection/config.php');


                        // check id image_name if is ser or not
                        if (isset($_GET['artikelID']) AND isset($_GET['image_name'])) {
                           
                        //get the value and delete
                            $id = $_GET['artikelID'];
                            $image_name = $_GET['image_name'];

                            // remove the available physical file 
                            if ( $image_name !="" ) {

                                $path= "../images/category/".$image_name;
                                //remove image
                                $remove = unlink($path);
                                //if failed to remove image
                                
                                    
                            } 

                            
                            // delete data from database
                            $sql = "DELETE FROM tbl_category WHERE artikelID=$id";

                            //execute query
                            $abfrage=$conn->query($sql);

                            //check if the data are deleted
                            if ($abfrage==true) {
                                //session message
                                $_SESSION['delete']= "<div class='success'> removed category </div>";
                                //redirect
                                header('location:'.SITEURL.'admin/manage-category.php');
                                }
                                
                            
                            else {
                                //session message
                                $_SESSION['delete']= "<div class='success'> failed to delete category </div>";
                                //redirect
                                header('location:'.SITEURL.'admin/manage-category.php');
                                    }

                                }
                            else
                            {
                            //redirect to mnage category
                            header('location:'.SITEURL.'admin/manage-category.php');
                            }



                        ?>