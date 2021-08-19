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
<h2 class="title is-2" id="title">Change Password</h2>


<?php 
if (isset($_GET['id'])) {
    $id = $_GET['id'];

}
?>

<form action="" method="POST">
<table class="table" id="table">
  <thead>
    <tr>
      
      <th scope="col">Current Password</th>
      <th scope="col">New Password</th>
      <th scope="col">Confirm Password</th>
      <th scope="col">Aktionen</th>
    </tr>
  </thead>
  <tbody>
    <tr>
   
    <td><input type="password" name="current_password" value="" required></td>
    <td><input type="password" name="new_password" value="" required></td>
    <td><input type="password" name="confirm_password" value="" required></td>
    <td> <button class="button" type="submit" name="submit" >Add</a></button></td>
 

</tr>
 
  </tbody>
</table>
</form>

</section>

<?php 

                  //check  if th button is clicked
                    if (isset($_POST['submit'])) {


                        $id = $_POST['id'];
                        $current_password = $_POST['current_password'];
                        $new_password = $_POST['new_password'];
                        $confirm_password = $_POST['confirm_password'];

                        // create sql query

                        $sql = "SELECT * FROM  tbl_admin  WHERE id='$id'  AND password = '$current_password'  ";

                        
                        //execute query

                        $abfrage=$conn->query($sql);

                      //check query if execute

                     if ($abfrage==true)
                        {
                        
                            
                            if ($new_password==$confirm_password)
                            {

                            $sql2  = "UPDATE tbl_admin SET 
                                password = '$new_password'
                            WHERE id='$id'
                            "; 

                            // execute query
                            $abfrage2=$conn->query($sql2);
          

            

                            //check if execute
                        if ($abfrage2==true)
                            {
                                $_SESSION['change-psw']= "<div class= 'success'>password changed</div>";
                                // redirect
                                header('location:'.SITEURL.'admin/manage-admin.php');
                                
                            }
                        else 
                            {
                                $_SESSION['change-psw']= "<div class= 'error'>password not changed</div>";
                                // redirect
                                header('location:'.SITEURL.'admin/manage-admin.php');
                                
                            }           
                    
                        }

                    }

                        else
                        {

                                $_SESSION['user-not-found']= "<div class= 'error'>user not found </div>";
                                // redirect
                                header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                }

?>