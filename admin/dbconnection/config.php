<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('SITEURL', 'http://localhost/spaghetti/');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'spaghetti');


 
/* Attempt to connect to MySQL database */
try{
    $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
    echo "3";
}
?>