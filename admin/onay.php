<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Randevular</title>
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


    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['kullanicitipi']!='a'){
            header("location: ../girisyap.php");
        }

    }else{
        header("location: ../girisyap.php");
    }
    
    

    //import database
    include("../baglanti.php");

    
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
                                    <p class="profile-title">Admin</p>
                                    <p class="profile-subtitle">admin@gmail.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../oturumkapat.php" ><input type="button" value="Çıkış yap" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Anasayfa</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doktorlar.php" class="non-style-link-menu "><div><p class="menu-text">Doktorlar</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule ">
                        <a href="takvim.php" class="non-style-link-menu"><div><p class="menu-text">Takvim</p></div></a>
                    </td>
                </tr>
               
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment none-menu-active ">
                        <a href="randevu.php" class="non-style-link-menu "><div><p class="menu-text">Randevu</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="hasta.php" class="non-style-link-menu"><div><p class="menu-text">Hastalar</p></a></div>
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
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Onay Bekleyen Randevular</p>
                                           
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

                        $list110 = $database->query("select  * from  randevu;");

                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                <!-- <tr>
                    <td colspan="4" >
                        <div style="display: flex;margin-top: 40px;">
                        <div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">Schedule a Session</div>
                        <a href="?action=add-session&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="margin-left:25px;background-image: url('../img/icons/add.svg');">Add a Session</font></button>
                        </a>
                        </div>
                    </td>
                </tr> -->
                
                
                <?php
                    if($_POST){
                        //print_r($_POST);
                        $sqlpt1="";
                        if(!empty($_POST["sheduledate"])){
                            $sheduledate=$_POST["sheduledate"];
                            $sqlpt1=" takvim.scheduledate='$sheduledate' ";
                        }


                        $sqlpt2="";
                        if(!empty($_POST["docid"])){
                            $docid=$_POST["docid"];
                            $sqlpt2=" doktor.docid=$docid ";
                        }
                        //echo $sqlpt2;
                        //echo $sqlpt1;
                        $sqlmain= "SELECT takvim.durum, doktor.docname,takvim.scheduleid,takvim.title,takvim.scheduledate,takvim.bitis
                        FROM takvim
                        INNER JOIN doktor ON takvim.docid = doktor.docid
                        WHERE takvim.durum = 0";

                        $sqllist=array($sqlpt1,$sqlpt2);
                        $sqlkeywords=array(" where "," and ");
                        $key2=0;
                        foreach($sqllist as $key){

                            if(!empty($key)){
                                $sqlmain.=$sqlkeywords[$key2].$key;
                                $key2++;
                            };
                        };
                        //echo $sqlmain;

                        
                        
                        //
                    }else{
                        $sqlmain= "SELECT takvim.durum, doktor.docname,takvim.scheduleid,takvim.title,takvim.scheduledate,takvim.bitis,takvim.durum
                        FROM takvim 
                        INNER JOIN doktor ON takvim.docid = doktor.docid 
                        WHERE takvim.durum = 0";

                    }



                ?>
                  
                <tr >
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0" style="margin-top:50px">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    Doktor adı   
                                </th>
                                <th class="table-headin">
                                    
                                    Randevu Başlığı
                                    
                                </th>
                               
                                
                                <th class="table-headin">
                                Başlangıç Randevu Tarihi ve Saati
                                </th>
                                <th class="table-headin">
                                    
                                
                                Bitiş Randevu Tarihi ve Saati
                                    
                                </th>
                                <th class="table-headin">
                                
                                    İşlemler
                                    </th>
                                    <th class="table-headin">
                                    
                                
                                    Durum
                                        
                                    </th>
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
                                for ($x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                     $scheduleid=$row["scheduleid"];
                                    $title=$row["title"];
                                    $docname=$row["docname"];
                                    $scheduledate=$row["scheduledate"];
                                    $bitistakvim=$row["bitis"];
                                    $durum = $row["durum"];
                                    echo '<tr >
                                        <td style="font-weight:600; text-align:center"> &nbsp;'.
                                        
                                        substr($docname,0,25)
                                        .'</td >
                                        <td style="text-align:center">
                                        '.$title.'
                                        
                                        </td>
                                        <td style="text-align:center">
                                        '.$scheduledate.'
                                        </td>      
                                        <td style="text-align:center">
                                            '.$bitistakvim.'
                                        </td>
                                            
                                        <td>
                                        <div style="display:flex;justify-content: center;">

                                       <a href="?action=drop&id='.$scheduleid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Onayla</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=red&id='.$scheduleid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Red</font></button></a>
                                       </div>
                                        </td>
                                        <td>
                                        '; 
                                        if($durum == 0)
                                        {
                                            echo '<span style="color:blue; text-align:center;">Onay Bekliyor </span>';
                                        }
                                        else
                                        {
                                            '<span style="color:red;">Belirsiz</span>';
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
    
    if (isset($_GET['action']) && $_GET['action'] == 'drop') {
        $sql = "UPDATE takvim SET durum=1 WHERE scheduleid=$scheduleid";
        if ($database->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $database->error;
        }
        $database->close();
        header("Location: onay.php");
        exit;
    } elseif (isset($_GET['action']) && $_GET['action'] == 'red') {
        $sql = "UPDATE takvim SET durum=2 WHERE scheduleid=$scheduleid";
        if ($database->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $database->error;
        }
        $database->close();
        header("Location: onay.php");
        exit;
    }

    ?>
    </div>

</body>
</html>