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

                        <?php
                        if (isset($_SESSION['upload']))
                        {
                        echo $_SESSION['upload']; 
                        unset($_SESSION['upload']);
                        } 
                        ?>

<h2 class="title is-2" id="title">Manage Category</h2>


<form action="" method="POST" enctype="multipart/form-data">


<table class="table" id="table">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Select Image</th>
      <th scope="col">Category</th>
      <th scope="col">Featured</th>
      <th scope="col">Active</th>  
    </tr>
  </thead>
  <tbody>
    <tr>
     
      <td><input type="text" name="title"  ></td>
      <td>
    <textarea name="description" cols="30" rows="5" placeholder="description" ></textarea>
    </td>
    <td>
    <input type="number" name="price" >
    </td> 
    <td>
    <input type="file" name="image" >
    </td> 
    <td>
                        <select name="category" >
                        <?php
                        //code to display categories from database 

                        //sql query to get active categories from database
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        // ececute query
                        //   
                        $abfrage=$conn->query($sql);

                        //count rows to check if we have categoriries or not
                        //   $count = mysqli_num_rows($res);
                        $count = $abfrage->rowCount();

                        //count the greater than zero so we know if we have categories or not

                        if ($count>0) {
                        //to display all categories from database
                while( $row= $abfrage->fetch() )
                        {
                                $id = $row['artikelID'];
                                $title = $row['artikelName'];
                                ?>

                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                        }
                        } 
                        else {
                        ?>
                        <option value="0">No category found</option>
                        <?php }        
                        ?>               
                        </select>
                        </td>  
                        <td>
                        <input type="radio" name="featured" value="Yes" required>Yes
                        <input type="radio" name="featured" value="No"required>No
                        </td>   
                        <td>
                        <input type="radio" name="active" value="Yes"required>Yes
                        <input type="radio" name="active" value="No"required>No
                        </td>  
                        <td colospan = "2">
                        <input type="submit" name="submit" value="add Produkt " class="button is-warning is-light">
                        </td> 
    
    </tr>
  
  </tbody>
</table>


</form>
<?php
                //if the button clicked or not
         if (isset($_POST['submit']))
              {
                //get the data fromn form

                $artikelName = $_POST['title'];
                $artikelBeschreibung = $_POST['description'];
                $artikelPreis= $_POST['price'];
                $artikelGruppe = $_POST['category'];

                //radio buttons where is active 
                if (isset($_POST['featured'])) 
                {

                        $featured = $_POST['featured'];                        
                } 
                else 
                {
                        $featured = "No"; // is default value
                }


                if (isset($_POST['active'])) 
                {

                        $active = $_POST['active'];
                }

                else
                 
                {
                        $active = "No";// is default value
                }   


                //upload the image if selected
                //checked if is clicked-selected or not 
                if (isset($_FILES['image']['name'])) 
                {

                        $image_name= $_FILES['image']['name'];
                        //check the images is selected or not  and upload image is selected
        if ($image_name!=" ") 
        {
                        //image is selected
                        //rename the image 
                        //get the extension of selected image(jpg,gif...)
                        $ext = end(explode('.', $image_name));

                        // create new name
                        $image_name = "Produkt-Name-".rand(0000,9999).".".$ext; // new image name
                        //upload the image
                        //source path 
                        $src = $_FILES['image']['tmp_name'];

                        //and destination
                        $dst = "../images/img/".$image_name;

                        //upload the Produkt image 
                        $upload = move_uploaded_file($src,$dst);
        
                   //check if the image is uploaded
         if ($upload==false) 
            {
                //redirect with error message
                $_SESSION['upload']="<div class= 'error'>Failed to upload image</div>";

                echo "<script type='text/javascript'>window.top.location='manage-item.php';</script>";
         }
       }
   }
         else
        {
                $image_name = ""; //default value is blank
        }
        
                $sql2 = "INSERT INTO artikel SET  
                artikelName = '$artikelName',
                artikelBeschreibung = '$artikelBeschreibung',
                artikelPreis = $artikelPreis,
                image_name = '$image_name',
                artikelGruppe = $artikelGruppe,
                featured = '$featured',
                active = '$active'
                ";
     
       $abfrage2=$conn->query($sql2);


       if ($abfrage2 == true) {
           $_SESSION['add'] = " <div class='success'>New Item Added</div>";
     echo "<script type='text/javascript'>window.top.location='manage-item.php';</script>";
                    
       } 
       else
        {
        $_SESSION['add'] = " <div class='error'>New Item  Not Added </div>";
    echo "<script type='text/javascript'>window.top.location='manage-item.php';</script>";
     }
}
?>
</section>