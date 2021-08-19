<?php
include('dbconnection/config.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) 
{ 
    //get id and image name
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];
  //remove the image if is avilable
  //delete only if is available
  if ($image_name =="") {

    //get the path
    $path = "../images/img/".$image_name;

    //remove file  from folder
    $remove = unlink($path);

    if ($remove==false) {
        $_SESSION['upload'] = "<div class='error'>failed to remove image.</div>";
        header('location:'.SITEURL.'admin/manage-item.php');
        //stop the process 
        die();

    }
  }

  //the query
  $sql = "DELETE FROM artikel WHERE artikelID=$id";
  //execute the query
  $abfrage=$conn->query($sql);

  //check the query execute it or not
  if ($abfrage == true) {
      //item deleted
    $_SESSION['delete'] = "<div class='success'>item deleted successfuly.</div>";
    header('location:'.SITEURL.'admin/manage-item.php');
  }
  else {
        //item deleted
    $_SESSION['unauthorized'] = "<div class='error'>item not deleted .</div>";
    header('location:'.SITEURL.'admin/manage-item.php');
  }

} 

else
{
    
    $_SESSION['delete'] = "<div class='error'>unathorised access.</div>";
    header('location:'.SITEURL.'admin/manage-item.php');

}


?>