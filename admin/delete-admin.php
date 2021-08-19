<?php

include('dbconnection/config.php');
//delete id
 $id = $_GET['id'];

// query delete
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//EXxecute the query

$abfrage=$conn->query($sql);

//check query if execute

if ($res==true) {
   //echo "Deleted";
   //Display message
   $_SESSION['delete']= "<div class='success'> Deleted succssfully.</div>";

   //return back Admin Page
   header('location:'.SITEURL.'admin/manage-admin.php');
   


}
else {
  // echo "not Deleted";
   $_SESSION['Delete']= "<div class='error'>fault dont deleted ,try again.</div>";
   //return back Admin Page
   header('location:'.SITEURL.'admin/manage-admin.php');
} 

?>