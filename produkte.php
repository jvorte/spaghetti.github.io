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
              <input class="form-control me-2" type="search"  name="search" placeholder="Search" aria-label="Search" required>
              <input type="submit" name="submit" value="Suchen" class="btn btn-outline-success">
            
  </form>


  </div>
</nav>
  

</div>

 <p class="fst-italic">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia esse dolorum inventore aliquam, ipsa neque exercitationem sed error in! Quis unde cum aliquid beatae neque fuga sunt porro enim quidem, atque assumenda impedit minus veritatis accusantium omnis, quaerat quibusdam molestiae. Cum perspiciatis accusamus maiores exercitationem incidunt at magni, iste maxime, ex eligendi ut. Sit, quia, porro ratione nemo id sunt quam rem harum dolorum temporibus aliquid cumque dolorem, minus modi consequuntur nisi consectetur nobis neque quo tempore! Quis voluptatibus, quibusdam nihil quidem atque similique omnis tempora aut architecto. Libero sed doloremque dicta odio, quo quam consequuntur recusandae magni eum accusantium.</p>
 <hr>


  <!-- ----------------end search-------------------------- -->

 <?php
            
            if(  isset($_POST["senden"]) && empty($_SESSION["username"])   ){
              
               echo "<script type='text/javascript'>window.top.location='login/login.php';</script>"; 
           }

                       //Wenn senden gedrückt wurde
                  

                       if(isset($_POST["senden"]) )
                       {
                                       
                           unset($_POST["senden"]);        

                   
                           $id=$_SESSION["id"];
                   
                       foreach($_POST as $key=>$value)
                       {
                       //echo " $key=>$value <br>";
                       $artikelID=(int)$key;	
                       $menge=(int)$value;		
                       
                       if($menge>0)
                       {
                           
                       //Artikelpreis aus DB
                       $sql="SELECT * FROM artikel
                       WHERE artikelID = :artikelID";

                       $stmt=$conn->prepare($sql);
                       $stmt->bindParam(":artikelID",$artikelID);
                       $stmt->execute();
                       $row=$stmt->fetch();

                       $artikelPreis=$row["artikelPreis"];

                 
                       //Einfügen in die DB 
                       $sql="INSERT INTO bestellungen
                       (bestArtikelFID,bestUserFID,artikelName,bestPreis,
                       bestStueck,bestUmsatz ,status,username)
                       VALUES
                       (:bestArtikelFID,:bestUserFID,:artikelName,
                       :bestPreis,:bestStueck,:bestUmsatz,:status,:username)";

                       $status="Bestellt";
                       $title=$row["artikelName"];
                       
                       $stmt=$conn->prepare($sql);
                       $stmt->bindParam(":bestArtikelFID",$artikelID);
                       $stmt->bindParam(":bestUserFID",$id);
                       $stmt->bindParam(":bestPreis",$artikelPreis);
                       $stmt->bindParam(":status",$status);
                       $stmt->bindParam(":artikelName",$title);
                       $stmt->bindParam(":bestStueck",$menge);
                       $stmt->bindParam(":username",$_SESSION["username"]);
                     

                       //Umsatz errechnen
                       $umsatz=$artikelPreis*$menge;
                       
                       $stmt->bindParam(":bestUmsatz",$umsatz);
                       $stmt->execute();		
                               
                   }//menge>0 ende
                   
               }//foreach ende

           }//senden Ende          
           ?>
 
      <section class="item-menu">
          <div class="container1">
           <form method="post">
           <!-- <input type="submit" name="senden"><br> -->
   
           <?php 
           //dispaly the active item
           $sql="SELECT * FROM artikel WHERE active='Yes'";

           $stmt=$conn->query($sql);

           
           //check the item if is available


           while ( $row= $stmt->fetch()) 
           {

               $id=0;
              $id = $row['artikelID'];
              $title = $row['artikelName'];
              $description = $row['artikelBeschreibung'];
              $price = $row['artikelPreis'];              
              $image_name = $row['image_name'];
              ?>

               <div class="item-menu-box1">
               <div class="item-menu-img">
               <?php 
               //check if image is enable or not


            if ($image_name=="") 
               {
                   echo "<div class='error'>image not available</div>";
               }
            else 
               {
               ?>
               <img src="<?php echo SITEURL;?>images/img/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                            
              <?php  
              } 
              ?>                                 
               </div>
               <div class="item-menu-desc">

               <h4><?php echo $title; ?></h4>
               <br>
               <textarea name="" id="" cols="30" rows="7" readonly><?php echo $description;?></textarea>
               
               <br><br>
               
               <p class="item-price">Preis <?php echo $price;?> €</p>
   

       <form method="post">                    

       <?php echo "<input type='number' 
                           name='$row[artikelID]' 
                           data-info='$row[artikelName]' 
                           data-price='$row[artikelPreis]'	                                           
                           min='0'>" ;
               ?>   stk.          		                          
                <br><br>
          <input type="submit" name="senden" value="Kaufen" class="btn btn-primary"><br>
         
         </form>
       
               </div>
           </div>              
              <?php             
            }          
           
           ?>  
  </section>

  </div>
</div>
</div>
</body>
</html>