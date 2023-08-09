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
    

    //import database
    include("../baglanti.php");
    $userrow = $database->query("select * from hasta where pemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];

    
    if($_GET){
        //import database
        include("../baglanti.php");
        $id=$_GET["id"];
        $result001= $database->query("select * from hasta where pid=$id;");
        $email=($result001->fetch_assoc())["pemail"];
        $sql= $database->query("delete from webkullanici where email='$email';");
        $sql= $database->query("delete from hasta where pemail='$email';");
        //print_r($email);
        header("location: ../oturumkapat.php");
    }


?>