<?php
    session_unset(); // remove value from the global array 
    session_destroy(); // delete all global array
    header("location: index.php");
    exit;
?>