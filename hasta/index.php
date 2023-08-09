<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Anasayfa</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,.anime{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    
    
</head>
<body>
    
    <?php

    //learn from w3schools.com

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

    require '../mylogger.php';
    myLogger::insert("Burası Log Dosyasından Geldi")
    //echo $userid;
    //echo $username;
    
    ?>

    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <a href="?action=drop&id=<?php echo $userid ?>"><input type="button" value="Çıkış yap" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                            <?php 
                
                            if($_GET)
                            {
                                $id=$_GET["id"];
                                $action=$_GET["action"];
                                if (isset($_GET['action']) && $_GET['action'] == 'drop') {

                                    date_default_timezone_set('Europe/Istanbul');
                                    $cikis_tarihi = date('Y-m-d H:i:s');
                                    $stmt = $database->prepare("UPDATE kullanici_log SET cikis_tarihi = ? WHERE kullanici_id = ? AND cikis_tarihi IS NULL");
                                    $stmt->execute([$cikis_tarihi, $id]);
                                    header('Location: ../oturumkapat.php');
            
                                
                                }
                            }
                            
                            ?>
                    </table>
                    </td>
                </tr>

                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-home menu-active menu-icon-home-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Anasayfa</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doktorlar.php" class="non-style-link-menu"><div><p class="menu-text">Tüm doktorlar</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="takvim.php" class="non-style-link-menu"><div><p class="menu-text">Aktif Randevular</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="randevu.php" class="non-style-link-menu"><div><p class="menu-text">Randevularım</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="iptal.php" class="non-style-link-menu"><div><p class="menu-text"> Pasif Randevularım</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="ayarlar.php" class="non-style-link-menu"><div><p class="menu-text">Ayarlar</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="1" class="nav-bar" >
                            <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Anasayfa</p>
                          
                            </td>
                            <td width="25%">

                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Bugünün Tarihi
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Asia/Kolkata');
        
                                $today = date('d-m-y');
                                echo $today;


                                $patientrow = $database->query("SELECT * FROM randevu WHERE pid = $userid AND rndurum = 1 AND appodate > CURDATE();");
                                $doctorrow = $database->query("select  * from  doktor;");
                                $appointmentrow = $database->query("SELECT * FROM randevu WHERE appodate = CURDATE() AND rndurum = 1 AND pid = $userid;");
                                $schedulerow = $database->query("SELECT * FROM randevu WHERE rndurum IN (2, 0, 3) AND pid = $userid;");


                                ?>
                                </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
        
        
                        </tr>
                <tr>
                    <td colspan="4" >
                        
                    <center>
                    <table class="filter-container doctor-header patient-header" style="border: none;width:95%" border="0" >
                    <tr>
                        <td >
                            <h3>Hoşgeldiniz!</h3>
                            <h1><?php echo $username  ?>.</h1>
                            
                            
                            
                            <form action="takvim.php" method="post" style="display: flex">

                                <input type="search" name="search" class="input-text " placeholder="Doktor Arayın Uygun Seansı Bulalım" list="doctors" style="width:45%;">&nbsp;&nbsp;
                                
                                <?php
                                    echo '<datalist id="doctors">';
                                    $list11 = $database->query("select  docname,docemail from  doktor;");
    
                                    for ($y=0;$y<$list11->num_rows;$y++){
                                        $row00=$list11->fetch_assoc();
                                        $d=$row00["docname"];
                                        
                                        echo "<option value='$d'><br/>";
                                        
                                    };
    
                                echo ' </datalist>';
    ?>
                                
                           
                                <input type="Submit" value="Ara" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                            
                            <br>
                            <br>
                            
                        </td>
                    </tr>
                    </table>
                    </center>
                    
                </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%"">
                            <tr>
                                <td width="50%">
                                    <center>
                                        <table class="filter-container" style="border: none;" border="0">
                                            <tr>
                                                <td colspan="4">
                                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Durum</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    <?php    echo $doctorrow->num_rows  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard">
                                                                    Aktif doktorlar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                                    </div>
                                                </td>
                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    <?php    echo $schedulerow->num_rows  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard">
                                                                    İptal Edilmiş Randevular &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                                    </div>
                                                </td>
                                                </tr>
                                                <tr>
                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex; ">
                                                        <div>
                                                                <div class="h1-dashboard" >
                                                                    <?php    echo  $patientrow->num_rows  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard" >
                                                                    Bügünden Sonraki Randevular &nbsp;&nbsp;
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');"></div>
                                                    </div>
                                                    
                                                </td>

                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;padding-top:21px;padding-bottom:21px;">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    <?php    echo $appointmentrow ->num_rows  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard" style="font-size: 15px">
                                                                Bugünkü Randevular
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/session-iceblue.svg');"></div>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        </table>
                                    </center>
                                </td>
                                <td>
                                    <p style="font-size: 20px;font-weight:600;padding-left: 40px;" class="anime">Yaklaşan Rezervasyonunuz</p>
                                    <center>
                                        <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0" >
                                        <thead>
                                            
                                        <tr>
                                        <th class="table-headin">
                                                    
                                                
                                                    Referans Numarası
                                                    
                                                    </th>
                                                <th class="table-headin">
                                                    
                                                
                                                Randevu Başlığı
                                                
                                                </th>
                                                
                                                <th class="table-headin">
                                                    Doktor İsmi
                                                </th>
                                                <th class="table-headin">
                                                    
                                                Randevu Tarihiniz
                                                    
                                                </th>
                                                    
                                                </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $nextweek=date("d-m-y",strtotime("+1 week"));
                                                $sqlmain= "SELECT doktor.docname, takvim.title, randevu.appodate,randevu.appoid
                                                FROM takvim 
                                                INNER JOIN randevu ON takvim.scheduleid = randevu.scheduleid 
                                                INNER JOIN hasta ON hasta.pid = randevu.pid 
                                                INNER JOIN doktor ON takvim.docid = doktor.docid 
                                                WHERE hasta.pid = $userid AND randevu.rndurum = 1 AND randevu.appodate BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 WEEK) 
                                                ORDER BY randevu.appodate ASC                                                
                                                ";
                                                //echo $sqlmain;
                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nothing to show here!</p>
                                                    <a class="non-style-link" href="takvim.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Channel a Doctor &nbsp;</font></button>
                                                    </a>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';
                                                    
                                                }
                                                else{
                                                for ( $x=0; $x<$result->num_rows;$x++){
                                                    $row=$result->fetch_assoc();
                                                    $title=$row["title"];
                                                    $docname=$row["docname"];
                                                    $randevutarih=$row["appodate"];
                                                    $apid=$row["appoid"];
                                                    echo '<tr>
                                                        <td style="padding:30px;font-size:15px;font-weight:700;">'.
                                                            'OC-000-'.$apid.
                                                        '</td>
                                                        <td style="padding:20px;"> &nbsp;'.
                                                        substr($title,0,30)
                                                        .'</td>
                                                        <td>
                                                        '.substr($docname,0,20).'
                                                        </td>
                                                        <td style="text-align:center;">
                                                            '.substr($randevutarih,0,10).'
                                                        </td>

                
                                                       
                                                    </tr>';
                                                    
                                                }
                                            }
                                                 
                                            ?>
                 
                                            </tbody>
                
                                        </table>
                                        </div>
                                        </center>

                                        
                                </td>
                            </tr>
                        </table>
                    </td>
                <tr>
            </table>
        </div>
    </div>


</body>
</html>