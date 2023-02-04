<?php
    

    function connection(){
        $servername = "localhost";
        $username = "root"; // default username for localhost

        $password = ""; // windows no password ... mac = 'root'
        $database = "minimart_catalog";

        // connection
        $connection = new mysqli($servername, $username, $password, $database);
            /* mysqli ---> a class in advance programming that holds more than one variable 

                ---> Represents a connection between PHP and a MySQL database
            
                $connection ---> holds the connection between PHP and a MySQL database.
                            ---> has now an access to communicate to our database.
            */

        // check the connection
        if($connection->connect_error){
            die("Connection Error: " . $connection->connect_error);
            // -> object operator that will us access the variables of mysqli
            // die() displays the error message of connect_error
        }
        else {
            return $connection;
            // echo 'connected!';
        }
    }

    // connection();
?>