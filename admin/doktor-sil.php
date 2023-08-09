<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['kullanicitipi']!='a'){
            header("location: ../girisyap.php");
        }

    }else{
        header("location: ../girisyap.php");
    }
    
    
    if($_GET){
     
        include("../baglanti.php");
        $id=$_GET["id"];
        $result001= $database->query("select * from doktor where docid=$id;");
        $email=($result001->fetch_assoc())["docemail"];
        $sql= $database->query("delete from webkullanici where email='$email';");
        $sql= $database->query("delete from doktor where docemail='$email';");
  
        header("location: doktorlar.php");
    }


?>