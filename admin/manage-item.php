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

<h2 class="title is-2" id="title">Manage Produkte</h2>

<?php
        if (isset($_SESSION['add']))
        {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete']))
        {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload']))
        {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
        }

        if (isset($_SESSION['unauthorized']))
        {
        echo $_SESSION['unauthorized'];
        unset($_SESSION['unauthorized']);
        }

        if (isset($_SESSION['update']))
        {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
        }

        ?>

<table class="table" id="table">
  <thead>
    <tr>
      <th scope="col">S.N</th>
      <th scope="col">Title</th>
      <th scope="col">Preis</th>
      <th scope="col">Bild</th>
      <th scope="col">Vorgestellt</th>
      <th scope="col">Aktiv</th>
      <th scope="col">Aktionen</th>
      <th> <a href="<?php echo SITEURL;?>admin/add-item.php" class="button is-warning is-light">Hinzufügen</a></th>
    </tr>
  </thead>
  <?php 
              
              //sql query to get all the item 
              $sql = "SELECT * FROM artikel";
              //execute the query
              $abfrage=$conn->query($sql);
              //count rows
              $count = $abfrage->rowCount();

              //create number variable and set default value as 1
              $sn=1;
              
              
              while( $row= $abfrage->fetch() )
              {
                  //get the values from colums
                  $id= $row['artikelID'];
                  $title1 = $row['artikelName'];
                  $price = $row['artikelPreis'];
                  $image_name = $row['image_name'];
                  $featured = $row['featured'];
                  $active = $row['active'];
                  ?>

  <tbody>
    <tr>
    <td><?php echo $sn++; ?></td>  
    <td><?php echo $title1; ?></td>           
    <td>€<?php echo $price; ?></td> 
    <td>
                    <?php 
                    //if exisist image

                    if ($image_name=="")
                     {
                        echo "<div class='error'>image not added</div>";

                     }
                     else 
                     {
                    ?>
                    
                        <img src="<?php echo SITEURL; ?>images/img/<?php echo $image_name;?>" width="100px"> 
                     <?php
                        
                     }
                    
                    ?>
                    </td> 
                    <td><?php echo $featured; ?></td> 
                    <td><?php echo $active; ?></td> 
                    <td>              
                    <a href="<?php echo SITEURL; ?>admin/update-item.php?id=<?php echo $id; ?>" class="button is-warning is-light">Aktualisieren</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-item.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="button is-warning is-light">Löschen</a>
                    </td>
                    <td>
                    
                    </td>   
    </tr>
    <?php 
     } 
    ?>
  </tbody>
</table>

</section>