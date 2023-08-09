<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['kullanicitipi']!='d'){
            header("location: ../girisyap.php");
        }

    }else{
        header("location: ../girisyap.php");
    }
    
    
    if($_POST){
        //import database

        include("../baglanti.php");

        $title=$_POST["title"];
        $userid=$_POST["docid"];

        //Log Açıldı
        $logMessage = "Yeni Seans Oluşturuldu Seansı Oluşturan Doktor $userid Senas Başlığı: $title" . $_SERVER['REMOTE_ADDR'];
        $stmt = $database->prepare("INSERT INTO doktorlogs (docid, date, message) VALUES (?, NOW(), ?)");
        $stmt->bind_param("is", $userid, $logMessage);
        $stmt->execute();
        //Log Kapandı
        
        $nop=10;
        $date=$_POST["date"];
        $bitis=$_POST["bitis"];
        $time=$_POST["time"];
        $durum=0;
        $klinik=$_POST["klinik"];
        $sql = "INSERT INTO takvim (docid, title, scheduledate, scheduletime, nop, bitis,durum,klinik_id) VALUES ('$docid', '$title', '$date', '$time', '$nop', '$bitis','$durum','$klinik')";
        $result= $database->query($sql);
        header("location: takvim.php?action=session-added&title=$title");
        
    }


?>