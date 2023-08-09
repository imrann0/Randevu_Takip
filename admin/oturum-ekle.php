<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['kullanicitipi']!='a'){
            header("location: ../girisyap.php");
        }

    }else{
        header("location: ../girisyap.php");
    }
    
    
    if($_POST){
        //import database
        include("../baglanti.php");
        $title=$_POST["title"];
        $docid=$_POST["docid"];
        $nop=$_POST["nop"];
        $date=$_POST["date"];
        $bitis=$_POST["bitis"];
        $time=0;
        $klinik_id=$_POST["klinik"];
        $durum=1;
        $sql = "INSERT INTO takvim (docid, title, scheduledate, scheduletime, nop, bitis,klinik_id,durum) VALUES ('$docid', '$title', '$date', '$time', '$nop', '$bitis','$klinik_id','$durum')";
        $result= $database->query($sql);
        header("location: takvim.php?action=session-added&title=$title");
        
    }


?>