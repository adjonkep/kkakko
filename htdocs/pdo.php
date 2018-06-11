<?php
          $servername = "localhost";
          $username = "root";
          $password = "11QV8uzrYYar";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=kkakko", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            echo "Connected successfully"; 
            $data = $conn->query('SELECT LastName FROM employee');
            $result = $data->fetchColumn();
            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
        ?>