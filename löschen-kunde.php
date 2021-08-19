
<?php include('dbconnection/config.php');?>
<?php 

if (isset($_GET['bestellID'])
) 
{ 
    //get id and image name
  $id = $_GET['bestellID'];
 
  $sql = "DELETE FROM bestellungen WHERE bestellID=$id AND status='bestellt'";
  //execute the query
  $abfrage=$conn->query($sql);

  //check the query execute it or not
  if ($abfrage == true) {
      //trip deleted
    $_SESSION['delete'] = "<div class='success'>trip deleted successfuly.</div>";
    header('location:'.SITEURL.'korb.php');
  }
  else {
        //trip deleted
    $_SESSION['unauthorized'] = "<div class='error'>trip not deleted .</div>";
    header('location:'.SITEURL.'korb.php');
  }

} 

else
{
    
    $_SESSION['delete'] = "<div class='error'>unathorised access.</div>";
    header('location:'.SITEURL.'korb.php');

}


?>