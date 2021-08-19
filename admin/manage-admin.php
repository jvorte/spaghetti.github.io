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
<h2 class="title is-2" id="title"> Admin</h2>
<?php 
               
               
               if (isset($_SESSION['add']))
                {
                       echo $_SESSION['add']; //display session message 
                       unset($_SESSION['add']);  //removing session message
                    
                    }

                    if (isset($_SESSION['delete'])) {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if (isset($_SESSION['update'])) {

                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if (isset($_SESSION['user-not-found'])) {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if (isset($_SESSION['not-mutch'])) {
                        echo $_SESSION['not-mutch'];
                        unset($_SESSION['not-mutch']);
                    }

                    if (isset($_SESSION['change-psw'])) {
                        echo $_SESSION['change-psw'];
                        unset($_SESSION['change-psw']);
                    }
                      
                       
                     
              $sql = "SELECT * FROM tbl_admin";

              $abfrage=$conn->query($sql);

              //check if query is execute
        if ($abfrage==TRUE) 
              {
                //  count  rows to check wheteher we have data in database or not


            $count = $abfrage->rowCount();; //functon to get all the rows to database 

                  // we have data  in data base 
          while( $row= $abfrage->fetch() )
                  {
                     //to get all the data from database

                     $id=$row['id'];
                     $username=$row['username'];                    
                     $created_at=$row['created_at']; 
                  }
             }

                ?>
               

  <table class="table" id="table">
  <thead>
    <tr> 
      <th scope="col">id</th>
      
      <th scope="col">Nutzername</th>
      <th scope="col">Erstellt</th>
      <th> <button class="button is-warning is-light"><a href="login_system\add-admin.php" class="button is-warning is-light">Neuen Benutzer hinzufügen</a></button></th>
    </tr>
  </thead>

  <tbody>
    <tr>
      <th scope="row"><?php  echo $id;?></th>
      <td><?php  echo $username;?></td>
      <td><?php  echo $created_at;?></td>
      
      <td>
       
        <a href="<?php echo SITEURL; ?>admin\delete-admin.php? id= <?php echo $id; ?>" class="button">Admin löschen</a>
       
      </td>
    </tr>
    <tr>
      
  </tbody>
</table>

</section>

</body>
</html>