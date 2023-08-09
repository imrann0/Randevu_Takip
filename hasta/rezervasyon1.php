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
    $username=$userfetch["pname"];

    date_default_timezone_set('Asia/Kolkata');

    $today = date('d-m-y');

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
                                 <a href="../oturumkapat.php" ><input type="button" value="Çıkış yap" class="logout-btn btn-primary-soft btn"></a>
                             </td>
                         </tr>
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
                    <a href="takvim.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Geri</font></button></a>
                    </td>
                    <td >
                            <form action="takvim.php" method="post" class="header-search">

                                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Doktor adı, e-posta -tarih ile arama yapın" list="doctors" >&nbsp;&nbsp;
                                        
                                        <?php
                                            echo '<datalist id="doctors">';
                                            $list11 = $database->query("select DISTINCT * from  doktor;");
                                            $list12 = $database->query("select DISTINCT * from  takvim GROUP BY title;");
                                            

                                            


                                            for ($y=0;$y<$list11->num_rows;$y++){
                                                $row00=$list11->fetch_assoc();
                                                $d=$row00["docname"];
                                               
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
            </table>
            <?php
            
   $id = $_GET["id"];
   $useremail=$_SESSION["user"];

        
        $sql = "SELECT doktor.zaman ,doktor.docid, doktor.docname
        FROM takvim
        INNER JOIN doktor ON takvim.docid = doktor.docid
        WHERE takvim.scheduleid = $id;";
        $res = $database->query($sql);
        $row = $res->fetch_assoc();
        $doktorIsim = $row['docname'];
        $dokid = $row["docid"];
        $zaman = $row["zaman"];

        $sql3= "select * from takvim inner join doktor on takvim.docid=doktor.docid where takvim.scheduleid=$id  order by takvim.scheduledate desc";
        $result= $database->query($sql3);
        $row3=$result->fetch_assoc();
        $scheduleid=$row3["scheduleid"];
        $scheduledate=$row3["scheduledate"];
        $bitis = $row3["bitis"];

        $bitistarih  = date('Y-m-d', strtotime($bitis));
        $min_date = date('Y-m-d');
        $date2 = date('Y-m-d', strtotime($scheduledate));
        if ($date2 < $min_date) {
            $date2 = $min_date;
        }
        $diff = abs(strtotime($date2) - strtotime($min_date));
        $target_date = date('Y-m-d', strtotime($date2 . ' + ' . $diff . ' seconds'));
        

        $sql1 = "SELECT klinik.id, klinik.klinikler
        FROM takvim
        INNER JOIN doktor ON takvim.docid = doktor.docid
        INNER JOIN klinik ON doktor.specialties = klinik.id
        WHERE takvim.scheduleid = $id";
        $res1 = $database->query($sql1);
        $row1 = $res1->fetch_assoc();
        $klinikad = $row1["klinikler"];
        $klinikid = $row1["id"];


        $hasta = "select * from hasta where pemail='$useremail'";
        $res2 = $database->query($hasta);
        $row2 = $res2->fetch_assoc();
        $hastatc = $row2["pnic"];
        $hastaad = $row2["pname"];

        $sql4="select * from randevu where scheduleid=$id";
        $result12= $database->query($sql4);
        $apponum=($result12->num_rows)+1;
                                                                                                 
        echo '
       
        <div class="" style="display: flex; justify-content: center; margin-top:60px">
        <div class="" style="width:1100px" >
            <form action="rezervasyon-tamamla.php" method="POST" class="add-new-form " style="padding-bottom:20px">
                <h2 >Randevu Al</h2>
                <input type="hidden" name="bitis1" value="'.$bitistarih.'" >
                <input type="hidden" name="scheduleid" value="'.$scheduleid.'" >
                <input type="hidden" name="apponum" value="'.$apponum.'" >
                <label for="title" class="form-label"  >Kimlik No:</label>
                <input type="text" name="" class="input-text"  value="'.$hastatc.'" readonly quired>
                </br>
                <label for="title" class="form-label"  >Ad Soyad:</label>
                <input type="text" name="" class="input-text"  value="'.$hastaad.'" readonly quired>
                </br>
                <label for="title" class="form-label">Klinik</label>
                <input type="text" name="" class="input-text" value="'.$klinikad.'"  readonly  required>
                <input type="hidden" name="klinikid" value="'.$klinikid.'" >
                </br>
                <label for="title" class="form-label">Doktor İsmi</label>
                <input type="text" name="" class="input-text" value="'.$doktorIsim.'"  readonly  required>
                <input type="hidden" name="docid" class="input-text" value="'.$dokid.'"  readonly  required>
                </br>
                <label for="date1" class="form-label">Başlangıç Tarihi:</label>
                <input type="date" name="date1" class="input-text" min="'.$target_date.'" max="'.$bitistarih.'" required>
                </br>

                <label for="rndtime" class="form-label">Saat Seç:</label>
                <select name="rndtime" class="box">';

                $start_time = strtotime('09:15');
                $end_time = strtotime('17:30');
                $interval = $zaman * 60; // 30 dakika = 30 * 60 saniye
                $ogle_basi = strtotime('12:30');
                $ogle_sonu = strtotime('13:30');
                $selected_date = $_POST['date1'];
                $doc_id = $dokid; // düzeltildi
                                
                // get already booked times for the selected date and doctor
                $booked_times = array();
                $sql = "SELECT * FROM randevu WHERE appodate = '$selected_date' AND docid = '$doc_id'"; // düzeltildi
                $res = $database->query($sql);
                while ($row = $res->fetch_assoc()) {
                    $booked_times[] = strtotime($row['rndtime']);
                }
                
                // create option tags for available times
                while ($start_time <= $end_time) {
                    $formatted_time = date('H:i', $start_time);
                    if (($start_time < $ogle_basi || $start_time >= $ogle_sonu) && !in_array($start_time, $booked_times)) {
                        echo "<option value=\"$formatted_time\">$formatted_time</option>";
                    }
                    $start_time += $interval;
                }
                
                
                
                
                
                echo '
                </select>
                </br></br>
                <div class="btn-group">
                <input type="reset" value="Sıfırla" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                <input type="submit" value="Bu oturumu kaydet" class="login-btn btn-primary btn" name="shedulesubmit">
                </div>
            </form>
            </div>
        </div>
        ';
?>
        </div>
    
    
    </div>
    
    
   
    </div>

</body>
</html>