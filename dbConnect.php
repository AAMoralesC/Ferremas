<?php
// Include the configuration file
require_once 'config.php';

// Connect with the database 
try {
    $db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME); 
 
    // Display error if failed to connect 
    if ($db->connect_errno) { 
        header('Location: error/index.html'); 
        exit(); 
    }
    
} 
catch (Exception $e) {
    header('Location: error/index.html'); 
        exit();
    
}