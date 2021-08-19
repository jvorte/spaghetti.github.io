<?php include('dbconnection/config.php')?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/main.css">
  <title>Document</title>
</head>
<body>

  

    <!-- ----------------- Navbar___--------------- -->
    
    
 <div class="bg-img">
               <!-- ---------------------login system----------------- -->


              <div class="dsp-user">

              <?php session_start(); ?>  
                      <?php

                      
                      // Check if the user is logged in, if not then redirect him to login page
                      if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){

                        
                          echo '<a href="login/login.php" class="out"><button  type="button"  class="btn btn-outline-primary">Anmelden</button></a>';
                          // echo "hi";
                      }
                      else {

                          ?>
                      <div class="in">
                        
                        <h4 class="hello">Hallo, <?php echo htmlspecialchars($_SESSION["username"]); ?></h4>
                  

                    <button class="btn btn-outline-light"><a href="reset-password.php" >Reset</a></button>
                    <button class="btn btn-outline-light"><a href="login/logout.php" >Sign Out</a></button>
                    <button type="button" class="btn btn-outline-light"><a href="korb.php">WarenKorb</a></button>
                      
                      </div>
                      <?php $username=$_SESSION["username"];
                      }
                    ?>
                 <!-- ---------------------end login system----------------- -->


</div>
  <div class="container">
    <div class="topnav">
      <a href="index.php">Home</a>
      <a href="categories.php">Categories</a>
      <a href="produkte.php">Produkte</a>
      <a href="uber_uns.php">Uber Uns</a>
      
    </div>
    
  <!-- -----------------End Navbar___--------------- -->
 
<!-- ----------------title-------------------------- -->

  </div>  <div class="logo"> <h1>Spaghetti Storries </h1><p>just join it..</p></div>


  <!-- ----------------end title-------------------------- -->

   <!-- ----------------search-------------------------- -->
  <nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
  <h1 class="">Alle Produkte</h1>
    <form class="d-flex" action="<?php echo SITEURL;?>produkte-search.php" method="POST">
      <input class="form-control me-2" type="search" placeholder="z.b pizza" aria-label="Suche">
      <button class="btn btn-outline-danger" type="submit">Suche</button>
    </form>
  </div>
</nav>
  

</div>

 <p class="fst-italic">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia esse dolorum inventore aliquam, ipsa neque exercitationem sed error in! Quis unde cum aliquid beatae neque fuga sunt porro enim quidem, atque assumenda impedit minus veritatis accusantium omnis, quaerat quibusdam molestiae. Cum perspiciatis accusamus maiores exercitationem incidunt at magni, iste maxime, ex eligendi ut. Sit, quia, porro ratione nemo id sunt quam rem harum dolorum temporibus aliquid cumque dolorem, minus modi consequuntur nisi consectetur nobis neque quo tempore! Quis voluptatibus, quibusdam nihil quidem atque similique omnis tempora aut architecto. Libero sed doloremque dicta odio, quo quam consequuntur recusandae magni eum accusantium.</p>
 <hr>


  <!-- ----------------end search-------------------------- -->

    <!-- ---------------- korb-------------------------- -->
<section>
                <table  class="table table-hover">
                <thead>       <tr>
                    <th>s.n</th>
                    <th >kundenNum</th>
                    <th >Bestellung</th>
                    <th >Name</th>
                    <th >Datum</th>
                    <th >Preis</th>
                    <th >Menge</th>
                    <th >Gesamt</th>
                    <th >Status</th>
                    <th >Aktionen</th>
                    <th >Löschen</th>
                    </tr>
                </thead>
            

                <?php

             $sql = "SELECT * FROM bestellungen where username='$username' ";
                    
                        //descending   we have the newer order on the top

                    //execute the query

                    $abfrage=$conn->query($sql);
                    //count rows
                    $count = $abfrage->rowCount();

                    // create serial number and start from 1
                    $sn =1;
                    //check  trip is available or not
                
                    while( $row= $abfrage->fetch() )
                    {
                        //get the order details
                    
                        $id = $row['bestellID'];
                        $bestDatum = $row['bestDatum'];                    
                        $price = $row['bestPreis'];
                        $qty = $row['bestStueck'];
                        $total = $row['bestUmsatz'];
                        $name = $row['bestUserFID'];
                        $status = $row['status'];
                        $artikelName = $row['artikelName'];?>    


                                       
                        <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $id;?></td>
                        <td><?php echo $artikelName;?></td>
                        <td><?php echo $bestDatum;?></td>
                        <td><?php echo $price;?></td>
                        <td><?php echo $qty;?></td>
                        <td><?php echo $total;?></td>
                        <td><?php echo $status;?></td>
                        <td>
                        <a href="<?php echo SITEURL;?>update-korb.php?bestellID=<?php echo $id;?>" class="btn-update" style="color: green;">Aktualisieren</a>
                        </td>
                        <td>
                        <a href="<?php echo SITEURL;?>löschen-kunde.php?bestellID=<?php echo $id;?>" class="btn-update" style="color: red;">Löschen</a>  </td> 
                        </tr>
               <?php                                            
                    }?>                
                </table> 
          
                </div>       
                </div> 
                 
                </section>

                  <!-- ----------------end korb-------------------------- -->