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

<h2 class="title is-2" id="title">Update Category</h2>

<?php  echo "jim1"; 
                // id is set or not  and bringt the resaults fromn database
            if (isset($_GET['artikelID']))
             {

                # get id and all others details
                $id = $_GET['artikelID'];
                //sql to get all details
                $sql = "SELECT * FROM tbl_category WHERE artikelID=$id";    
                
                //execute query
               
                $abfrage=$conn->query($sql);

                //count the rows to check if is valid
                $count = $abfrage->rowCount();

              
                    # get all data
                    while( $row= $abfrage->fetch() )
                    {
                    $title = $row['artikelName'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    echo "jim";
                    }
                         
            }        
        
           
            ?>

<form action="" method="POST" enctype="multipart/form-data">
<table class="table" id="table">

  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Aktuelles Bild</th>
      <th scope="col">Neues Bild</th>
      <th scope="col">Vorgestellt</th>
      <th scope="col">Activ</th>
    </tr>
  </thead>
  <tbody>

   <tr>

    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
    <td><?php
        if ($current_image!="") 
        {
            //display image in manage category
            ?>
            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>" width="150px">
            <?php
        }
        else 
        {
            //display message...
            echo "<div class='error'>image not added.</div>";
        }
        ?> 
      </td>
      <td><input type="file" name="image" value=""></td>
      <td>
      <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

      <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
      </td>

      <td>
      <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

      <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
      <td>

      <td>
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                <input type="hidden" name="id" value="<?php echo $id; ?>"> 

                <input type="submit" name="submit" value="Upadate Category" class="button is-warning is-light">
            </td>

     </tr>
  
  </tbody>
</table>

</form>


<?php

              if (isset($_POST['submit'])) 
                {

                            # get the value from the form
                            $id = $_POST['id'];
                            $title = $_POST['title'];
                            $current_image = $_POST['current_image'];
                            $featured = $_POST['featured'];
                            $active = $_POST['active'];

                            //check image   if is selected
                    if (isset($_FILES['image']['name'])) 
                            {
                                // get image details
                                $image_name=$_FILES['image']['name'];

                                // check if the image are available
                    if ($image_name!= "") {
                                    # image available
                                    
                                    //************upload the  file
                                    //  and remove tje old image
                                    

                            //get the the extension of our image
                            $ext = end(explode('.',$image_name));

                            // rename image
                            $image_name = "Produkt_Category_".rand(000,999).'.'.$ext;

                            //upload the file only if is selected
                    if ($image_name!="") {
                                
                            $src_path = $_FILES['image']['tmp_name'];

                            $destination_path= "../images/category/".$image_name;

                            //upload img
                            $upload = move_uploaded_file($src_path,$destination_path);

                            //check the image is uploaded
                    if ($upload==false) {
                                $_SESSION['upload']=  "<div class='error'>failed to upload image</div>";
                                // redirect add category
                                header('location:'.SITEURL.'admin/manage-category.php');
                                //stop the process
                                die();
                         
                                //************remove the old file
                        

                            //remove the image if is available
                            if ($current_image!="") {

                                
                                $remove_path = "../images/category/".$current_image;

                                $remove = unlink($remove_path);
                                
                                //check the image removed - if failed display message
                            if ($remove==false) {
                                    # failed remove image
                                    $_SESSION['failed-remove']=  "<div class='error'>remove failed</div>";
                                    // redirect add category
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die();

                                }
                            }
                   
                        }
                } 
                
                $remove_path = "../images/category/".$current_image;

                $remove = unlink($remove_path);


                    } 
                    else {
                        # code...
                        $image_name = $current_image;
                    } 

                } 
                else
                 {

                    $image_name = $current_image;
                }


                //update the database
                $sql2 = " UPDATE tbl_category SET
                artikelName = '$title',
                image_name= '$image_name',
                featured ='$featured',
                active = '$active' 
                WHERE artikelID=$id
                ";

                //execute query
                $abfrage2=$conn->query($sql2);


                if ($abfrage2==true) {
                    //category update

                    $_SESSION['update']=  "<div class='success'>category Updated successfuly</div>";
                    // redirect add category
                     header('location:'.SITEURL.'admin/manage-category.php');
                   
                } 
                else {


                    $_SESSION['update']=  "<div class='error'>Category Not Updated </div>";
                    // redirect add category
                     header('location:'.SITEURL.'admin/manage-category.php');
                    # code...
                }
                

                }



                ?>



</section>