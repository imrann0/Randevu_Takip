<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['kullanicitipi']!='p'){
            header("location: ../girisyap.php");
        }

    }else{
        header("location: ../girisyap.php");
    }
    
    
    if ($_GET) {
        //import database
        include("../baglanti.php");
    
        $id = $_GET["id"];
        $userid = $_GET["hastaid"];
    
        // create a log message
        $logMessage = "Randevu İptal Edildi Eden Hasta id $userid" . $_SERVER['REMOTE_ADDR'];
    
        // insert the log message into the hastalogs table
        $stmt = $database->prepare("INSERT INTO hastalogs (pid, date, message) VALUES (?, NOW(), ?)");
        $stmt->bind_param("is", $userid, $logMessage);
        $stmt->execute();
    
        // update the randevu table
        $sql = $database->query("UPDATE randevu SET rndurum = 0 WHERE appoid = '$id'");
    
        header("location: randevu.php");
    }


?>