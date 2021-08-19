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

<h2 class="title is-2" id="title">  Update Bestellungen</h2>

<?php
                    //check id is set or not

                    if (isset($_GET['bestellID']))
                    {
                        $id=$_GET['bestellID'];

                        $sql= "SELECT * FROM bestellungen WHERE bestellID=$id";

                        $abfrage=$conn->query($sql);

                        $count = $abfrage->rowCount();

                        //check the data are available or not
                 if ($count==1)
                        {
                            
                            $row= $abfrage->fetch();
                            
                            $produkt = $row['artikelName']; 
                            $qty = $row['bestStueck'];
                            $price = $row['bestUmsatz'];                          
                            $produktPr = $row['bestPreis'];                                                    
                            $status = $row['status'];
                            $name = $row['bestUserFID'];
                            $datum = $row['bestDatum'];
                            $id = $row['bestellID'];
                           

                            
                            }
                        else 
                            {
                                
                                header('location:'.SITEURL.'admin/manage-order.php');
                            }
                            

                            } 
                        else 
                            {
                                header('location:'.SITEURL.'admin/manage-order.php');
                            }                  
       
        
        
                            ?>

            <form action="" method="POST">

                 <table class="table" id="table">
                    <thead>
                        <tr>
                        <th scope="col">Bestellung ID</th>
                        <th scope="col">Produkt Name</th>
                        <th scope="col">Menge</th>
                        <th scope="col">Produkt Preis</th>
                        <th scope="col">Summe</th>
                        <th scope="col">Status</th>
                        <th scope="col">Customer Nummer</th>
                        <th scope="col">Bestellung Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td><?php echo $id;?></td>
                        <td><?php echo $produkt;?></td>
                        <td>
                        <input type="number" name="bestStueck" value="<?php echo $qty;?>">
                        </td>
                        <td><?php echo $produktPr;?> €</td>

                        <td><?php echo $price;?> €</td>

                        <td>
                                    <select name="status" bestellID=" ">

                                <option <?php if ($status=="bestellt") { echo "selected"; }?> value="bestellt">bestellt</option>
                                <option <?php if ($status=="bearbeitet") { echo "selected"; }?> value="bearbeitet">bearbeitet</option>
                                <option <?php if ($status=="bezahlt") { echo "selected"; }?> value="bezahlt">bezahlt</option>
                                <option <?php if ($status=="storniert") { echo "selected"; }?> value="storniert">storniert</option>

                                    </select>
                                </td>
                                <td><?php echo $name;?></td>

                                <td><?php echo $datum?></td>

                                <td colspan="2"> 
                                    <input type="hidden" name="bestellID" value="<?php echo $id;?>">
                                    <input type="hidden" name="bestUmsatz" value="<?php echo $price;?>">
                                <input type="submit"  class="button is-warning is-light" name="submit" value="Update order">

                                </td>
                                 </tr>
                      
                    </tbody>
                    </table>

                    </form>

                    <?php 

                        //check the update button clicked or not

                        if (isset($_POST['submit'])) 
                        {
                            //  echo "clicked"; 
                            $id = $_POST['bestellID'];                        
                            $qty = $_POST['bestStueck'];
                            $status = $_POST['status'];
                            
                            $sql2 = "UPDATE bestellungen SET
                            bestStueck = $qty,                       
                            status = '$status'                           
                            WHERE bestellID= $id         
                            "; 

                          

                            $abfrage2=$conn->query($sql2);

                            if ($abfrage2 == true)
                            {
                              $_SESSION['update'] = "<div class='success'>updated </div>";
                            //   header('location:'.SITEURL.'manage-order.php');
                              echo "<script type='text/javascript'>window.top.location='manage-order.php';</script>"; 
                              
                            }
                            else 
                            {
                               
                                $_SESSION['update'] = "<div class='error'>Not updated </div>";
                                // header('location:'.SITEURL.'manage-order.php');
                                echo "<script type='text/javascript'>window.top.location='manage-order.php';</script>"; 
                            }
                            
                          

                        } 
                      
                        $sql= "SELECT * FROM users  WHERE $name = id";

                        $abfrage=$conn->query($sql);
    
                        $count = $abfrage->rowCount();
    
                        //check the data are available or not
                        if ($count==1)
                        {    
                            
                            $row= $abfrage->fetch();
                            
                            $id = $row['id']; 
                            $username = $row['username'];
                            $password = $row['password'];                          
                            $created_at = $row['created_at'];                                                    
                            $fullname = $row['fullname'];
                            $contact = $row['contact'];
                            $email = $row['email'];
                            $address = $row['address'];                    
    
                            
                        }
                        
                ?>  


<br>

                <table class="table" id="table">
                <thead>
                    <tr>
                    <th scope="col">Customer Nummer</th>
                    <th scope="col">Username</th>
                    <th scope="col">Mitglied Datum</th>
                    <th scope="col">Vollname</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    
                    <td><?php echo $id;?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $created_at;?> </td>
                    <td><?php echo $fullname;?></td>
                    <td><?php echo $contact;?></td>
                    <td><?php echo $email;?></td>
                    <td> <?php echo $address;?></td>
                   
                    </tr>
                   
                </tbody>
                </table>     




</section>
