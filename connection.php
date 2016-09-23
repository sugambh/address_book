<?php 
define('DB_host', 'localhost');
define('DB_username', 'root'); 
define('DB_password','');
define('DB_name','address_book');

         try
           {
             $db = new PDO("mysql:host=".DB_host.";dbname=".DB_name,DB_username,DB_password);

           }

         catch(PDOException $e)
          {
             echo $e->getMessage(); 
           }

?>