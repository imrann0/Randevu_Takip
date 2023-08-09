<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['kullanicitipi']!='d'){
            header("location: ../girisyap.php");
        }

    }else{
        header("location: ../girisyap.php");
    }
    
    
    if($_GET){
        //import database
        include("../baglanti.php");
        $id=$_GET["id"];
        $userid = $_GET["userid"];
        //Log Açıldı
        $logMessage = "Randevu Tamamlandı Tamamlanan Randevu $id Randevu Tamamlayan Doktor ID $userid" . $_SERVER['REMOTE_ADDR'];
        $stmt = $database->prepare("INSERT INTO doktorlogs (docid, date, message) VALUES (?, NOW(), ?)");
        $stmt->bind_param("is", $userid, $logMessage);
        $stmt->execute();
        //Log Kapandı

        $id=$_GET["id"];
        $sql= $database->query("UPDATE randevu SET rndurum = 4 WHERE appoid = '$id'");
        header("location: randevu.php");
    }


?>