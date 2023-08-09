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
        //import database
        include("../baglanti.php");
        $id=$_GET["id"];
        $sql= $database->query("UPDATE randevu SET rndurum = 2 WHERE appoid = '$id'");
        header("location: randevu.php");
    }


?>