<?php include('dbconnection/config.php');

session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login_system.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>Admin</title>
</head>
<body>
<!-- -----------------------Navbar----------------------------------------------- -->
<section >



<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
 
  <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
  <p class="title is-3 is-spaced">Adminnistrator-Verwaltung</p>

    <div class="navbar-start">
      <a href=""></a>

      <h2 class="title is-5" > <a class="navbar-item" href="index.php">
        Kontrolle
      </a></h2> 

      <h2 class="title is-5" > <a class="navbar-item" href="manage-admin.php">
        Admin
      </a></h2> 

      <h2 class="title is-5" > <a class="navbar-item" href="manage-category.php">
        Categories
      </a></h2> 

      <h2 class="title is-5" > <a class="navbar-item" href="manage-item.php">
        Produkte
      </a></h2> 


      <h2 class="title is-5" > <a class="navbar-item" href="manage-order.php">
        Bestellungen
      </a></h2> 
</div>
<!-- ------------------------login Name---------------------------------------- -->
    <div class="navbar-end">
      <div class="navbar-item">

<div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
    </div>
    <p>
        <a href="login_system/reset-password.php" class="button is-success is-light">Reset</a>
        <a href="login_system/logout.php" class="button is-success is-light">Sign Out</a>
    </p>
</div>
    </div>

    <!-- ------------------------End login Name------------------------ -->


  </div>
</nav>

</section>
<!-- -----------------------End Navbar----------------------------------------------- -->

<section>
<h2 class="title is-2" id="title">Manage Category</h2>

<?php
        if (isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        } 

        if (isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        } 

        if (isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        } 
           
        if (isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }  
        if (isset($_SESSION['failed-remove']))
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
     
        ?>

            <table class="table" id="table">
            <thead>
                <tr> 
                <th scope="col">S.N</th>
                <th scope="col">Title</th>
                <th scope="col">Bild</th>
                <th scope="col">Vorgestellt</th>
                <th scope="col">Aktiv</th>
                <th scope="col">Aktionen</th>
                <th> <a href="<?php echo SITEURL; ?>admin/add-category.php"  class="button is-warning is-light">Kategorie hinzufügen</a></th>
                
                </tr>
            </thead>
            
            <?php
              $sql= "SELECT * FROM tbl_category";

              //execute

              $abfrage=$conn->query($sql);
              //count rows
              $count = $abfrage->rowCount();
              //check if we have data or no

            //   create $sn variable and set 1
            $sn=1;

            
            while( $row= $abfrage->fetch() )
            {
            
                     $id= $row['artikelID'];
                     $title = $row['artikelName'];
                     $image_name = $row['image_name'];
                     $featured = $row['featured'];
                     $active = $row['active']; 

                    ?> 
  

         <tbody>
      <tr>
      <td><?php echo $sn++;?></td>
      <td><?php echo $title;?></td>
      
      <td>
      <?php

//   dispaly the iomage - set the path
  if ($image_name!="") {
      ?>
      
      <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width="100px">                      
      
      <?php
  } else {
      echo "<div class='error'>image not added </div>";
  }
  
?>
    </td>
    <td><?php echo $featured;?></td>
    <td><?php echo $active;?></td>
    <td>
    <a href="<?php echo SITEURL;?>admin/update-category.php?artikelID=<?php echo $id;?>" class="button is-warning is-light">Kategorie aktualisieren</a>
    <a href="<?php echo SITEURL;?>admin/delete-category.php?artikelID=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="button is-warning is-light">Loschen Categorie</a>
    </td>
    </tr>
    <?php    
    }
    ?>   
</tbody>
</table>
</section>