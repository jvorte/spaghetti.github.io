<?php include('dbconnection/config.php');

session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/login_system.php");
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

    <div class="columns is-desktop" id="front">


                <div class="column">
                <div class="box">
                
                <?php

                $sql = "SELECT * FROM tbl_category";

                $abfrage=$conn->query($sql);
                $count = $abfrage->rowCount();                            
                ?>
                <h1 class="title">Kategorien</h1>
                <h2 class="subtitle"><?php echo $count;?></h2>

               </div>
                </div>


                <div class="column">
                <div class="box">
                <?php

                $sql2 = "SELECT * FROM artikel";

                $abfrage2=$conn->query($sql2);
                $count2 = $abfrage2->rowCount();                            

                ?>

                <h1 class="title">Produkte</h1>
                <h2 class="subtitle"><?php echo $count2;?></h2>
                </div>
                </div>



                <div class="column">
                <div class="box">
                <?php

                $sql3 = "SELECT * FROM bestellungen";

                $abfrage3=$conn->query($sql3);
                $count3 = $abfrage3->rowCount();                             

                ?>
                <h1 class="title">Bestellungen
                </h1>
                 <h2 class="subtitle"><?php echo $count3;?></h2>
                </div>
                </div>


                <div class="column">
                <div class="box">
                <?php

                $sql4 = "SELECT SUM(bestellID) AS Total FROM bestellungen WHERE status ='bezahlt'" ;


                $abfrage4=$conn->query($sql4);

                $row4 = $abfrage4->fetch();


                $total_revenue = $row4['Total'] ;                          

                ?>
                 <h1 class="title">Gesamt</h1>
                <h2 class="subtitle"><?php echo $total_revenue;?> €</h2>
                </div>
                </div>

</div>
</section>

</body>
</html>