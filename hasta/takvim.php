<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Oturumlar</title>
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
    $sql = "UPDATE takvim SET durum = FALSE WHERE bitis < NOW()";
    $database->query($sql);
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];


    //echo $userid;
    //echo $username;
    
    date_default_timezone_set('Asia/Kolkata');

    $today = date('Y-m-d');


 //echo $userid;
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
                    <td class="menu-btn menu-icon-home " >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Anasayfa</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doktorlar.php" class="non-style-link-menu"><div><p class="menu-text">Tüm doktorlar</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                        <a href="takvim.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Aktif Randevular</p></div></a>
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
        <?php
                
                $sqlmain= "select * from takvim inner join doktor on takvim.docid=doktor.docid where takvim.durum=1  order by takvim.durum asc";
                $sqlpt1="";
                $insertkey="";
                $q='';
                $searchtype="Tüm";
                        if($_POST){
                        //print_r($_POST);
                        
                        if(!empty($_POST["search"])){
                            
                            $keyword=$_POST["search"];
                            $sqlmain= "SELECT *
                                FROM takvim
                                INNER JOIN doktor ON takvim.docid = doktor.docid
                                INNER JOIN klinik ON doktor.specialties = klinik.id
                                WHERE takvim.bitis >= '$today'
                                        AND (doktor.docname = '$keyword'
                                            OR doktor.docname LIKE '$keyword%'
                                            OR doktor.docname LIKE '%$keyword'
                                            OR doktor.docname LIKE '%$keyword%'
                                            OR takvim.title = '$keyword'
                                            OR takvim.title LIKE '$keyword%'
                                            OR takvim.title LIKE '%$keyword'
                                            OR takvim.title LIKE '%$keyword%'
                                            OR takvim.scheduledate LIKE '$keyword%'
                                            OR takvim.scheduledate LIKE '%$keyword'
                                            OR takvim.scheduledate LIKE '%$keyword%'
                                            OR takvim.scheduledate = '$keyword'
                                            OR klinik.klinikler = '$keyword'
                                            OR klinik.klinikler LIKE '$keyword%'
                                            OR klinik.klinikler LIKE '%$keyword'
                                            OR klinik.klinikler LIKE '%$keyword%')
                                            AND takvim.durum = 1
                                ORDER BY takvim.scheduledate ASC";
                            //echo $sqlmain;
                            $insertkey=$keyword;
                            $searchtype="Search Result : ";
                            $q='"';
                        }

                    }
                    
                
                $result= $database->query($sqlmain)


                ?>
                  
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="index.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Geri</font></button></a>
                    </td>
                    <td >
                            <form action="" method="post" class="header-search">

                                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Doktor adı,e-posta veya klinik ile arama yapın" list="doctors" value="<?php  echo $insertkey ?>">&nbsp;&nbsp;
                                        
                                        <?php
                                            echo '<datalist id="doctors">';
                                            $list11 = $database->query("select DISTINCT * from  doktor GROUP BY docname;");
                                            $list12 = $database->query("select DISTINCT * from  takvim GROUP BY title;");
                                            $klinik = $database->query("select DISTINCT * from  klinik GROUP BY klinikler;");
                                            
                            
                                            


                                            for ($y=0;$y<$list11->num_rows;$y++){
                                                $row00=$list11->fetch_assoc();
                                                $d=$row00["docname"];
                                               
                                                echo "<option value='$d'><br/>";
                                               
                                            };

                                            for ($y=0;$y<$klinik->num_rows;$y++){
                                                $row00=$klinik->fetch_assoc();
                                                $d=$row00["klinikler"];
                                               
                                                echo "<option value='$d'><br/>";
                                               
                                            };


                                            for ($y=0;$y<$list12->num_rows;$y++){
                                                $row00=$list12->fetch_assoc();
                                                $d=$row00["title"];
                                               
                                                echo "<option value='$d'><br/>";
                                                                                         };

                                        echo ' </datalist>';
            ?>
                                        
                                
                                        <input type="Submit" value="Ara" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                        </form>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Bugünün Tarihi
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                                
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
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $searchtype." Randevular"."(".$result->num_rows.")"; ?> </p>
                        <p class="heading-main12" style="margin-left: 45px;font-size:22px;color:rgb(49, 49, 49)"><?php echo $q.$insertkey.$q ; ?> </p>
                    </td>
                    
                </tr>
                
                
                
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                            
                        <tbody>
                        
                            <?php

                                
                                

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="takvim.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Tüm oturumları göster &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                    //echo $result->num_rows;
                                for ( $x=0; $x<($result->num_rows);$x++){
                                    echo "<tr>";
                                    for($q=0;$q<3;$q++){
                                        $row=$result->fetch_assoc();
                                        if (!isset($row)){
                                            break;
                                        };
                                        $scheduleid=$row["scheduleid"];
                                        $title=$row["title"];
                                        $docname=$row["docname"];
                                        $docid=$row["docid"];
                                        $scheduledate=$row["scheduledate"];
                                        $bitis=$row["bitis"];
                                        $scheduletime=$row["scheduletime"];
                                        $spe=$row["specialties"];
                                        $spcil_res= $database->query("select klinikler from klinik where id='$spe'");
                                        $spcil_array= $spcil_res->fetch_assoc();
                                        $spcil_name=$spcil_array["klinikler"];

                                        if($scheduleid==""){
                                            break;
                                        }

                                        echo '
                                        <td style="width: 25%;">
                                                <div  class="dashboard-items search-items"  >
                                                
                                                    <div style="width:100%">
                                                            <div class="h1-search">
                                                                '.strtoupper(substr($title,0,21)).'
                                                            </div><br>
                                                            <div class="h3-search">
                                                                '.substr($docname,0,30).'
                                                            </div>
                                                            <div class="h3-search">
                                                            Branş : '.substr($spcil_name,0,20).'
                                                        </div>
                                                            <div class="h4-search">
                                                                Başlangıç Tarih :'.substr($scheduledate,0,10).' /<b> Saat: '.substr($scheduledate,10,16).'</b>
                                                            </div>
                                                            <div class="h4-search">
                                                                Bitiş Tarih: '.substr($bitis,0,10).' <b> Saat: '.substr($bitis,10,16).'</b>
                                                            </div>
                                                            <br>';

                                                            
                                                            $sql = "SELECT * FROM randevu WHERE pid = $userid";
                                                            $res = $database->query($sql);
                                                            $takvim_docid = $docid;
                                                            $already_booked = false;
                                                            $can_book = true;
                                                            $already_booked = false;
                                                            $selected_klinik_id = null;
                                                            
                                                            while ($row = $res->fetch_assoc()) {
                                                                $klinik_id = $row['klinikid'];
                                                                $randevu_docid = $row["docid"];
                                                            
                                                                if ($randevu_docid == $takvim_docid && $row['rndurum'] == 1) {
                                                                    $already_booked = true;
                                                                    break;
                                                                }
                                                            
                                                                if ($row['rndurum'] == 1) {
                                                                    $selected_klinik_id = $klinik_id;
                                                                }
                                                            }
                                                            
                                                            if ($already_booked) {
                                                                echo "Bu doktordan zaten bir randevunuz var!";
                                                            } else if ($selected_klinik_id != null && $selected_klinik_id != $klinik_id) {
                                                                echo "Aynı anda sadece bir klinikten randevu alabilirsiniz.";
                                                            } else {
                                                                echo ' <a href="rezervasyon1.php?id='.$scheduleid.'" ><button name="randevu_al" class="login-btn btn-primary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Randevu Al</font></button></a>
                                                                ';
                                                            }
                                                            
                                                            
                                                            echo '
                                                            
                                                    </div>
                                                            
                                                </div>
                                            </td>';

                                    }
                                    echo "</tr>";
                                    
                                    
                                    
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

    </div>

</body>
</html>
