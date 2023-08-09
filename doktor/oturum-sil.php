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
        $logMessage = "Sens İptal Edildi İptal Eden ID: $userid  Seans ID: $id" . $_SERVER['REMOTE_ADDR'];
        $stmt = $database->prepare("INSERT INTO doktorlogs (docid, date, message) VALUES (?, NOW(), ?)");
        $stmt->bind_param("is", $userid, $logMessage);
        $stmt->execute();
        //Log Kapandı

        $sql= $database->query("UPDATE randevu SET rndurum = 2 WHERE scheduleid = '$id'");
        $sql= $database->query("UPDATE takvim SET durum = 2 WHERE scheduleid = '$id'");
        header("location: takvim.php");
    }


?>