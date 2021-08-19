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


<!-- ----------------update korb-------------------------- -->

<div class="bestel-l">
                
                    
                    <br><br>

                    <?php if (isset($_GET['bestellID']))
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
                                
                                header('location:'.SITEURL.'korb.php');
                            }
                            

                            } 
                        else 
                            {
                                header('location:'.SITEURL.'korb.php');
                            }


                        if (isset($_POST['submit'])) 
                        {
                         
                            $id = $_POST['bestellID'];                        
                            $qty = $_POST['bestStueck'];

                            $sql2 = "UPDATE bestellungen SET
                            bestStueck = $qty                      
                           WHERE bestellID= $id         
                            ";                           

                            $abfrage2=$conn->query($sql2);

                            if ($abfrage2 == true)
                            {
                                $_SESSION['update']=  "<div class='success'><h2>Ihre Bestellung updated</h2></div>";
                               echo "<script type='text/javascript'>window.top.location='korb.php';</script>"; 
                            }
                            else 
                            {
                               
                                $_SESSION['update']=  "<div class='success'><h2>Bestellung  not updated</h2></div>";
                                 echo "<script type='text/javascript'>window.top.location='update-korb.php';</script>"; 
                            }              
                          

                        }
                      
                        $sql= "SELECT * FROM users  WHERE $name = id";

                        $abfrage=$conn->query($sql);
    
                        $count = $abfrage->rowCount();
    
                        //check the data are available or not
                        if ($count==1)
                        {    
                            
                            $row= $abfrage->fetch();
                            
                            $cust_id = $row['id']; 
                            $username = $row['username'];
                            $password = $row['password'];                          
                            $created_at = $row['created_at'];                                                    
                            $fullname = $row['fullname'];
                            $contact = $row['contact'];
                            $email = $row['email'];
                            $address = $row['address'];                    
    
                            
                        }?>  

                        
                        
                     
</div>
                  

</div>
<div class="p-3 mb-2 bg-dark text-white"></div>
<fieldset>
<legend>Meine Daten</legend>
<form class="row g-3 needs-validation" novalidate method="POST">
  <div class="col-md-1">
    <label for="validationCustom01" class="form-label">VollName</label>
    <input type="text" class="form-control" id="validationCustom01" name="username" value="<?php echo $fullname;?>"> 
    <div class="valid-feedback">
      Looks good!
    </div><br>
  </div>
  <div class="col-md-1">
    <label for="validationCustom02" class="form-label">Customer-Nummer</label>
    <input type="text" class="form-control" id="validationCustom02"  name="" value="<?php echo $cust_id;?>" >
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-1">
    <label for="validationCustomUsername" class="form-label">Username</label>
    <div class="input-group has-validation">
     
      <input type="text" class="form-control" id="validationCustomUsername"value="<?php echo $username; ?>" >
      
    </div>
  </div>
  <div class="col-md-2">
    <label for="validationCustom03" class="form-label">Email</label>
    <input type="email" name="email" value="<?php echo $email;?>" class="form-control" >
   
  </div>
  <div class="col-md-2">
    <label for="validationCustom03" class="form-label">Adresse</label>
    <input type="text" name="address" value="<?php echo $address;?>"class="form-control" id="validationCustom03" >
   
  </div>
    
  </div>
  <div class="col-md-1">
    <label for="validationCustom05" class="form-label">Kontakt</label>
    <input type="text"name="" value="<?php echo $contact;?>" class="form-control" id="validationCustom05" >
    
  </div>
  <div class="col-md-2">
    <label for="validationCustom05" class="form-label">Mitglied-Datum</label>
    <input type="text"name=""  value="<?php echo $created_at;?>"class="form-control" id="validationCustom05" >
   
  </div>
    </div>
  </div>
  
  
<legend>Meine Bestellung</legend>

<div class="col-md-2">
    <label for="validationCustom05" class="form-label">Bestellung Datum:</label>
    <input type="text"name="" value="<?php echo $datum?>" class="form-control" id="validationCustom05" >
    
  </div>
  <div class="col-md-1">
    <label for="validationCustom05" class="form-label">Bestellung Nr</label>
    <input type="text"name="" value="<?php echo $id;?>" class="form-control" id="validationCustom05" >
    
  </div>
  <div class="col-md-1">
    <label for="validationCustom05" class="form-label">Produkt Name</label>
    <input type="text"name="" value="<?php echo $produkt;?>" class="form-control" id="validationCustom05" >
    
  </div>
  <div class="col-md-1">
    <label for="validationCustom05" class="form-label">Produkt Preis</label>
    <input type="text"name="" value="<?php echo $produktPr?>" class="form-control" id="validationCustom05" >
    
  </div>
  <div class="col-md-1">
    <label for="validationCustom05" class="form-label">Summe</label>
    <input type="text"name="" value="<?php echo $price?>" class="form-control" id="validationCustom05" >
    
  </div>
  <div class="col-md-1">
    <label for="validationCustom05" class="form-label">Menge</label>
  
    <input type="text"  value="<?php echo $qty;?>"class="form-control"  >
   
  </div>
  <div class="col-md-1">
    <label for="validationCustom05" class="form-label">Status</label>
    <input type="text" name="bestStueck"  value="<?php echo $status;?>"class="form-control" id="validationCustom05" >
   
  </div>
<br>


  <div class="">
  <tr>
   <td>Update Menge</td>
     <td>
       <input type="number" name="bestStueck" value="<?php echo $qty;?>"> <input type="hidden" name="bestellID" value="<?php echo $id?>">
    <button class="btn btn-primary" name="submit" type="submit">Submit</button>
     </td>


                     
</form>
</fieldset>

<!-- ----------------end update korb-------------------------- -->