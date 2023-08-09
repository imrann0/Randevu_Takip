<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Randevu</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
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
     //Randevu Tarihi Geçti
    $sql = "UPDATE randevu SET rndurum = 3 WHERE rndurum = 1 AND bitis < NOW()";
    $database->query($sql);


    //echo $userid;
    //echo $username;


    $sqlmain= "SELECT randevu.appoid,takvim.scheduleid,takvim.title,doktor.docname,hasta.pname,takvim.scheduledate,takvim.scheduletime,randevu.apponum,randevu.appodate,randevu.rndtime,randevu.bitis,randevu.docid,randevu.klinikid,randevu.rndurum 
    FROM takvim 
    INNER JOIN randevu ON takvim.scheduleid=randevu.scheduleid 
    INNER JOIN hasta ON hasta.pid=randevu.pid 
    INNER JOIN doktor ON takvim.docid=doktor.docid 
    WHERE hasta.pid=$userid AND (randevu.rndurum=0 or randevu.rndurum=3 or randevu.rndurum=4 or randevu.rndurum=2)";
    
    if($_POST){
        //print_r($_POST);
    
        if(!empty($_POST["sheduledate"])){
            $sheduledate=$_POST["sheduledate"];
            $sqlmain.=" AND takvim.scheduledate='$sheduledate' ";
        }
    
        //echo $sqlmain;
    
    }
    
    $sqlmain.=" ORDER BY randevu.appodate ASC";
    $result= $database->query($sqlmain);
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
                    <td class="menu-btn menu-icon-home" >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Anasayfa</p></a></div></a>
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
                    <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                        <a href="iptal.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Pasif Randevular</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="ayarlar.php" class="non-style-link-menu"><div><p class="menu-text">Ayarlar</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="index.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Geri</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Randevu Geçmişim</p>
                                           
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

                        
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Geçmiş Randevularım (<?php echo $result->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;" >
                        <center>
                        <table class="filter-container" border="0" >
                        <tr>
                           <td width="10%">

                           </td> 
                        <td width="5%" style="text-align: center;">
                        Tarih:
                        </td>
                        <td width="30%">
                        <form action="" method="post">
                            
                            <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                        </td>
                        
                    <td width="12%">
                        <input type="submit"  name="filter" value=" Filtrele" class=" btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>

                    </tr>
                            </table>

                        </center>
                    </td>
                    
                </tr>
                
               
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                Hasta adı
                                </th>
                                <th class="table-headin">
                                    
                                Randevu numarası
                                    
                                </th>
                                <th class="table-headin">
                                    
                                
                                    Doktor İsmi
                                        
                                        </th>
                                <th class="table-headin">
                                    
                                
                                Randevu Başlığı
                                    
                                    </th>
                                
                                <th class="table-headin" >
                                    
                                Randevu Tarihi ve Saati
                                    
                                </th>
                                
                                <th class="table-headin">
                                    
                                Randevu Bitiş Tarihi
                                    
                                </th>
                                
                                <th class="table-headin">
                                    
                                    Durum
                                    
                                </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                                
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="randevu.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Tüm randevuları göster &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $appoid=$row["appoid"];
                                    $scheduleid=$row["scheduleid"];
                                    $title=$row["title"];
                                    $docname=$row["docname"];
                                    $scheduledate=$row["scheduledate"];
                                    $scheduletime=$row["scheduletime"];
                                    $pname=$row["pname"];
                                    $apponum=$row["apponum"];
                                    $appodate=$row["appodate"];
                                    $durum = $row["rndurum"];
                                    $zaman = $row["rndtime"];
                                    $bitist = $row["bitis"];
                                    echo '<tr >
                                        <td style="font-weight:600;"> &nbsp;'.
                                        
                                        substr($pname,0,25)
                                        .'</td >
                                        <td style="text-align:center;font-size:20px;font-weight:300; color: var(--btnnicetext);">
                                        '.$apponum.'
                                        
                                        </td>
                                        <td style="text-align:center;">
                                        '.$docname.'
                                        </td>
                                        <td style="text-align:center;">
                                        '.substr($title,0,15).'
                                        </td>
                                        <td style="text-align:center;;">
                                            '.substr($appodate,0,10).' '.substr($zaman,0,5).'
                                        </td>
                                        
                                        <td style="text-align:center;">
                                            '.$bitist.'
                                        </td>

                                        <td style="text-align:center;;">
                                        <div style="display:flex;justify-content: center;">
                                        '; 
                                        if($durum == 0)
                                        {
                                            echo '<span style="color:red;"> İptal Edildi</span>';
                                        }
                                        elseif($durum == 2)
                                        {
                                            echo '<span style="color:blue;">Doktor İptal</span>';
                                        }
                                        elseif($durum == 3)
                                        {
                                            echo '<span style="color:red;">Gelmedi</span>';
                                        }
                                        elseif($durum == 4)
                                        {
                                            echo '<span style="color:green;">Tamamlandı</span>';

                                        }
                                        echo'
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
        </div>
    </div>
    <?php

    ?>
    </div>

</body>
</html>
