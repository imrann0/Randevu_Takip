<?php

    $database= new mysqli("localhost","root","","randevukayit");
    $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

    if ($database->connect_error){
        myLogger::insert("Bağlantı hatası: " . $database->connect_error);
        die("Connection failed:  ".$database->connect_error);
    }    $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        
        if ($database->connect_error){
            die("Connection failed:  ".$database->connect_error);
        }

?>