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
<h2 class="title is-2" id="title">Update Produkte</h2>

<?php 
        if (isset($_GET['id']))
        {
                        
                        # get id and all others details
                    $id = $_GET['id'];
                    //sql to get all details
                    $sql2 = "SELECT * FROM artikel WHERE artikelID=$id";    
                    
                    //execute query
                    $abfrage2=$conn->query($sql2);
                    //get the value based on query executed
                    while( $row2= $abfrage2->fetch() )
                    {

                    $title = $row2['artikelName'];
                    $description = $row2['artikelBeschreibung'];
                    $price = $row2['artikelPreis'];
                    $current_image = $row2['image_name'];
                    $current_category = $row2['artikelGruppe'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];       
                   }
                   
        }
                    
                ?>
<form action="" method="POST" enctype="multipart/form-data">

<table class="table" id="table">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Beschreibung</th>
      <th scope="col">Preis</th>
      <th scope="col">Aktuelles Bild</th>
      <th scope="col">Neues Bild auswählen</th>
      <th scope="col">Kategorie</th>
      <th scope="col">Featured</th>
      <th scope="col">Active</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <td>
    <input type="text" name="title" value="<?php echo $title;?>">
    </td>

      <td>
    <textarea name="description" id="" cols="30" rows="5"><?php echo $description; ?></textarea>
    </td>

       <td>
        <input type="number" name="price" value="<?php  echo $price;?>">
        </td>
        <td><?php
                if ($current_image == "") 
                {
                     //display message...
                     echo "<div class='error'>image not added.</div>";
                    //display image in manage category
                 }
                else 
                {
                    ?>
                    <img src="<?php echo SITEURL; ?>images/img/<?php echo $current_image; ?>" width="150px">
                    <?php
                    
                }
                    ?> 
                   </td>

                   <td>
                    <input type="file" name="image">
                
                    </td>

                    <td>
                    <select name="category">

                    <?php
                    //query to get active categories
                    $sql= "SELECT * FROM tbl_category WHERE active ='Yes'";
                    //execute query
                    $abfrage=$conn->query($sql);
                    //count rows
                    $count = $abfrage->rowCount();

            if ($count>0) 
                {                 
                while( $row= $abfrage->fetch() )
                {
                    $category_title = $row['artikelName'];
                    $category_id = $row['artikelID'];                  

                    // echo "<option value='$category_id'>$category_title</option>";             
                    ?>

                    <!-- dispaly the values  -->
                    <option <?php if ($current_category == $category_id) {echo "Selected"; }?>value="<?php echo $category_id;?>"><?php echo $category_title; ?></option>
                    <?php
            
                }                
                } 
                
                else
                {
                    echo "<option value='0'>Category not avialable.</option>";
                }          

                
                ?>

            
                </select>
                </td>

                <td>
                <input <?php if ($featured == "Yes") {echo "checked"; }?> type="radio" name="featured" value="Yes">Ya
                <input <?php if ($featured == "No") {echo "checked"; }?> type="radio" name="featured" value="No">Nein
                </td>
               
                <td>
                <input <?php if ($active == "Yes") {echo "checked"; }?> type="radio" name="active" value="Yes">Ya
                <input <?php if ($active == "No") {echo "checked"; }?> type="radio" name="active" value="No">Nein
                </td>

                <td>
                <input type="hidden" name="id" value="<?php echo $id; ?>" > 
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>"> 

                <input type="submit" name="submit" value="Update item" class="button is-warning is-light">                 
                </td>


            </tr>
  
         </tbody>
      </table>
    </form>


                <?php if (isset($_POST['submit']))
                 {

                        # get the value from the form
                        $id = $_POST['id'];
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $current_image = $_POST['current_image'];
                        $category = $_POST['category'];
                        $featured = $_POST['featured'];
                        $active = $_POST['active'];

                //upload button is clicked

                    if (isset($_FILES['image']['name'])) 
                        {
                            // get image details
                            $image_name=$_FILES['image']['name']; // new name

                    if ($image_name!="") 
                    {
                                //get the the extension of our image

                        $ext = end(explode('.',$image_name));

                        // rename image
                        $image_name = "item_Name_".rand(0000,9999).'.'.$ext;


                        $src_path = $_FILES['image']['tmp_name']; //sourse path

                        $dest_path= "../images/img/".$image_name; //destination path

                        $upload = move_uploaded_file($src_path,$dest_path); // upload image

                    if ($upload==false) 
                        {
                            $_SESSION['upload']=  "<div class='error'>failed to upload image</div>";
                            // redirect add category
                            header('location:'.SITEURL.'admin/update-item.php');
                            //stop the process
                            die();
                            }
                      if($current_image!=""){
                        $remove_path = "../images/img/".$current_image;

                        $remove = unlink($remove_path);

                          //check the image removed - if failed display message
                    if ($remove==false) 
                    {
                        # failed remove image
                        $_SESSION['remove=failed']=  "<div class='error'>remove failed</div>";
                        // redirect add category
                        header('location:'.SITEURL.'admin/update-item.php');
                        die();
                     }
                      }      
                    }                
                      else 
                    {
                        $image_name = $current_image; // default image if the image is not selected
                    }   
                 }
                 
            
                 else 
                    {
                        $image_name = $current_image; // deg=fault when butto is not clicked
                    } 

                  
                    //update the database
                    $sql3 = " UPDATE artikel SET
                    artikelName = '$title',
                    artikelBeschreibung ='$description',
                    artikelPreis =$price,
                    image_name ='$image_name',
                    artikelGruppe ='$category',
                    featured ='$featured',            
                    active = '$active' 
                    WHERE artikelID=$id
                    ";   
                    
              //execute query
              $abfrage3=$conn->query($sql3);
             

              if ($abfrage3=true)
               {
                //category update

                $_SESSION['update']=  "<div class='update'>item Updated successfuly</div>";
             
                 echo "<script type='text/javascript'>window.top.location='manage-item.php';</script>"; 
               
                } 
            else {


                $_SESSION['update']=  "<div class='error'>item Not Updated </div>";
                // redirect add category
                echo "<script type='text/javascript'>window.top.location='manage-item.php';</script>";
         
            }
}?>
   </div>
</div>
</section>