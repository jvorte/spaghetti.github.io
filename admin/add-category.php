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
        <a href="../login_system/reset-password.php" class="button is-success is-light">Reset</a>
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

<h2 class="title is-2" id="title">Add Category</h2>

<form action="" method="POST" enctype="multipart/form-data">
<table class="table" id="table">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Featured</th>
      <th scope="col">Active</th>
      <th scope="col">Select Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <td>
    <input type="text" name="artikelName" placeholder="Category title"required>
    </td>

    <td>
        <input type="radio" name="featured" placeholder="yes" value="yes"required>Yes
        <input type="radio" name="featured" placeholder="no" value="no"required>No
    </td>

      <td>
      <input type="radio" name="active" placeholder="yes" value="yes"required>Yes
      <input type="radio" name="active" placeholder="no" value="no"required>No
      </td>

      <td>
      <input type="file" name="image">
      </td>

      
      <td colspan='2'>
      <input type="submit" name="submit" value="Add Category " class="button is-warning is-light">
      </td>
      </tr>
 
  </tbody>
</table>
</form>
<?php
    
    if (isset($_POST['submit'])) 
    {

            // get the value from form
            $title = $_POST['artikelName'];
            //radio button check selected
if (isset($_POST['featured'])) 
 {

                $featured= $_POST['featured'];

            }
        else
            {
                $featured = "no";

            }
        if (isset($_POST['active']))
            {
                $active= $_POST['active'];
            }
        else
            {
                $active ="no";
            }
            // check if img selected nas set the value for image
            
    if (isset($_FILES['image']['name']))
       {

            //upload img , we need name /source /path

        $image_name = $_FILES['image']['name'];

     if ($image_name != "")
        {
        //  **  auto rename image**

        //get the the extension of our image
        $ext = end(explode('.',$image_name));

        // rename image
        $image_name = "item_category_".rand(000,999).'.'.$ext;

        //upload the file only if is selected
    
            $source_path = $_FILES['image']['tmp_name'];

        $destination_path= "../images/category/".$image_name;
        

        //upload img
        $upload = move_uploaded_file($source_path,$destination_path);

        //check the image is uploaded
        
        if ($upload==false)
         {

        $_SESSION['upload']=  "<div class='error'>failed to upload image</div>";
        // redirect add category
        header('location:'.SITEURL.'admin/add-category.php');
        //stop the process
        die();
       }

        }
     else 
        {

      $image_name= "";

      }
         // sql query
         $sql= "INSERT INTO tbl_category SET
          artikelName =' $title',
          image_name= '$image_name',
          featured = '$featured',
          active = '$active' 
          ";

          //execute query and save

          $abfrage=$conn->query($sql);
          //check if query executed

          if ($abfrage==true) 
          {
              $_SESSION['add'] =  "<div class='success'> Added succssfully.</div>";
              //redirect to category page
              header('location:'.SITEURL.'admin\manage-category.php');

             
          } 
          else 
          {
            $_SESSION['add']=  "<div class='error'> Added Not succssfully.</div>";
            //redirect to category page
            header('location:'.SITEURL.'admin\add-category.php');
            echo "ok";
          }       

}
}



?>
</section>