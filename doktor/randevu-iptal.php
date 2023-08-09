<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['kullanicitipi']!='a'){
            header("location: ../girisyap.php");
        }

    }else{
        header("location: ../girisyap.php");
    }
    
    include("../baglanti.php");
    if($_GET){

        $userid = $_GET["userid"];
        $id=$_GET["id"];

        //Log Açıldı
        $logMessage = "Randevu İptal Edildi  Eden Doktor ID: $userid Randevu ID: $id " . $_SERVER['REMOTE_ADDR'];
        $stmt = $database->prepare("INSERT INTO doktorlogs (docid, date, message) VALUES (?, NOW(), ?)");
        $stmt->bind_param("is", $userid, $logMessage);
        $stmt->execute();
        //Log Kapandı
            
        $sql= $database->query("UPDATE randevu SET rndurum = 2 WHERE appoid = '$id'");
        header("location: randevu.php");
    }


?>