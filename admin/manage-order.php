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

<h2 class="title is-2" id="title"> Bestellungen</h2>

<table class="table" id="table">
  <thead>
    <tr>
      <th scope="col">S.N</th>
      <th scope="col">kundenNum</th>
      <th scope="col">Bestellung</th>
      <th scope="col">Name</th>
      <th scope="col">Datum</th>
      <th scope="col">Preis</th>
      <th scope="col">Menge</th>
      <th scope="col">Gesamt</th>
      <th scope="col">Status</th>
      <th scope="col">Aktionen</th>
    </tr>
  </thead>
  <?php
                //get the orders from database
                
                    $sql = "SELECT * FROM bestellungen ORDER BY bestellID DESC "; //descending   we have the newer order on the top

                    //execute the query

                    $abfrage=$conn->query($sql);
              //count rows
                   $count = $abfrage->rowCount();

                    // create serial number and start from 1
                    $sn =1;
                    //check  item is available or not
                   

                
                    while( $row= $abfrage->fetch() )
                    {
                        //get the order details
                       
                        $bestellID = $row['bestellID'];
                        $bestDatum = $row['bestDatum'];                    
                        $price = $row['bestPreis'];
                        $qty = $row['bestStueck'];
                        $total = $row['bestUmsatz'];
                        $name = $row['bestUserFID'];
                        $status = $row['status'];
                        $artikelName = $row['artikelName'];    


                        ?>
                      <tbody>
                       <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $name;?></td>                           
                            <td><?php echo $bestellID ;?></td>
                            <td><?php echo $artikelName;?></td>
                            <td><?php echo $bestDatum;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $total;?></td>
                            <td><?php echo $status;?></td>
    
             <?php
                            //check the status of the order
                            if ($status=="bestellt") {
                                echo "<label>$status</label> ";
                            }
                            elseif ($status=="bearbeitet") {
                                echo "<label style= 'color: orange;'>$status</label> ";
                            }
                            elseif ($status=="bezahlt") {
                                echo "<label style= 'color: green;'>$status</label> ";
                            }
                            elseif ($status=="storniert") {
                                echo "<label style= 'color: red;'>$status</label> ";
                            }
                            
                            ?> -->
                            </td>

                            
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update-order.php?bestellID=<?php echo $bestellID;?>" class="button is-warning is-light">Aktualisieren</a>
                            </td>                    
                         </tr>

                        <?php                                            
                    }              

                ?>   
  
  </tbody>
</table>

</section>