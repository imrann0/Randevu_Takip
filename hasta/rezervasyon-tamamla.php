<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['kullanicitipi']!='p'){
            header("location: ../girisyap.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../girisyap.php");
    }

    include("../baglanti.php");
    $userrow = $database->query("select * from hasta where pemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];

    
    
    if($_POST){
    
        // create a log message

    
        $apponum = $_POST["apponum"];
        $scheduleid = $_POST["scheduleid"];

        //Log Açıldı
        $logMessage = "Randevu Aldı $userid Oturumid $scscheduleid" . $_SERVER['REMOTE_ADDR'];
        $stmt = $database->prepare("INSERT INTO hastalogs (pid, date, message) VALUES (?, NOW(), ?)");
        $stmt->bind_param("is", $userid, $logMessage);
        $stmt->execute();
        //Log Kapandı

        $today = date('d-m-y');
        $appodate = $_POST["date1"];
        $rndtime = $_POST["rndtime"];
        $selected_date = $_POST["date1"];
        //$bitis = $_POST["bitis"];
        $nextday = strtotime($appodate . ' +1 day');
        $bitis = date('Y-m-d', $nextday);
        $docid = $_POST["docid"];
        $klinikid = $_POST["klinikid"];
        $durum=1;
        $sql2 ="insert into randevu(pid,apponum,scheduleid,appodate,rndtime,bitis,docid,klinikid,rndurum) values ('$userid','$apponum','$scheduleid','$appodate','$rndtime','$bitis','$docid','$klinikid','$durum')";
        $result= $database->query($sql2);
        header("location: randevu.php?action=booking-added&id=".$apponum."&titleget=none");
        
    }




   /* if($_POST){
        if(isset($apponum=$_POST["apponum"];$_POST["booknow"])){
            
            $scheduleid=$_POST["scheduleid"];
            $date=$_POST["date"];
            $bugunun_tarihi = date('Y-m-d'); 
            $hafta_sonrasi_tarihi = date('Y-m-d', strtotime('+1 week'));
            $scheduleid=$_POST["scheduleid"];
            $sql2="insert into randevu(pid,apponum,scheduleid,appodate) values ($userid,$apponum,$scheduleid,'$hafta_sonrasi_tarihi')";
            $result= $database->query($sql2);
            //echo $apponom;
            header("location: randevu.php?action=booking-added&id=".$apponum."&titleget=none");

        }
    } */
    
 ?>