<?php
    $host      = 'localhost';
    $user      = 'sam';
    $pass      = '5455199b';
    $dbname    = 'crud';
    try 
    {
        $PDO =  new PDO( "mysql:host=".$host.";"."dbname=".$dbname, $user, $pass);  
    }
    catch(PDOException $e) 
    {
        die($e->getMessage());  
    }
?>