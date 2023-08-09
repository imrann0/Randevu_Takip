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
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Doktor Bilgi Grafiği</p>
                                           
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
                            <td>
                            <form action="" method="post">
                            
                            <input type="date" name="sheduledate" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                            </td>
                            <td width="5%" style="text-align: center;">
                            Doktor:
                            </td>
                            

                            <td width="30%">
                            <select name="docid" id="" class="box filter-container-items" style="width:90% ;height: 37px;margin: 0;" >
                                <option value="" disabled selected hidden>Listeden bir doktor seçin</option><br/>
                                    
                                <?php 
                                
                                    $list11 = $database->query("select  * from  doktor order by docname asc;");

                                    for ($y=0;$y<$list11->num_rows;$y++){
                                        $row00=$list11->fetch_assoc();
                                        $sn=$row00["docname"];
                                        $id00=$row00["docid"];
                                        echo "<option value=".$id00.">$sn</option><br/>";
                                    };


                                    ?>

                            </select>
                        </td>
                        <td width="12%">
                            <input type="submit"  name="filter" value=" Filtrele" class=" btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                            </form>
                        </td>

                        </tr>
                    <?php
                        if($_POST){
                            // Listedeki Hepsini Listelemesi İçin
                            $gelmeyen = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 3");
                            $row1 = $gelmeyen->fetch_assoc();
                            $count = $row1['count'];

                            $tamamlanan = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 4");
                            $row2 = $tamamlanan->fetch_assoc();
                            $coun = $row2['count'];

                            $iptal = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 0 or rndurum = 2");
                            $row3 = $iptal->fetch_assoc();
                            $count2 = $row3['count'];

                            $aktif = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 1");
                            $row4 = $aktif->fetch_assoc();
                            $count3 = $row4['count'];

                            //$sqlpt1=""; Tarih Seçimİ Yapılamıypr
                            if(!empty($_POST["sheduledate"]) && !empty($_POST["docid"])){
                                $tarih = $_POST["sheduledate"];
                                $docid = $_POST["docid"];
                                $gelmeyen = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 3 AND docid = $docid AND bitis = '$tarih'");
                                $row1 = $gelmeyen->fetch_assoc();
                                $count = $row1['count'];

                                $tamamlanan = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 4  AND docid = $docid AND bitis = '$tarih'");
                                $row2 = $tamamlanan->fetch_assoc();
                                $coun = $row2['count'];

                                $iptal = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 0  AND docid = $docid AND bitis = '$tarih'");
                                $row3 = $iptal->fetch_assoc();
                                $count2 = $row3['count'];

                                $iptal2 = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 2  AND docid = $docid AND bitis = '$tarih'");
                                $row5 = $iptal2->fetch_assoc(); 
                                $count2 += $row5['count'];

                                $aktif = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 1  AND docid = $docid AND bitis = '$tarih'");
                                $row4 = $aktif->fetch_assoc();
                                $count3 = $row4['count'];
                            }
                            elseif(!empty($_POST["sheduledate"])){

                                $tarih = $_POST["sheduledate"];
                                echo $tarih;
                                $gelmeyen = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 3 AND bitis = '$tarih'");
                                $row1 = $gelmeyen->fetch_assoc();
                                $count = $row1['count'];

                                $tamamlanan = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 4 AND bitis = '$tarih'");
                                $row2 = $tamamlanan->fetch_assoc();
                                $coun = $row2['count'];

                                $iptal = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 0  AND bitis = '$tarih'");
                                $row3 = $iptal->fetch_assoc();
                                $count2 = $row3['count'];

                                $iptal2 = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 2  AND bitis = '$tarih'");
                                $row5 = $iptal2->fetch_assoc(); 
                                $count2 += $row5['count'];

                                $aktif = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 1 AND bitis = '$tarih'");
                                $row4 = $aktif->fetch_assoc();
                                $count3 = $row4['count'];
                            }
    
    
                            elseif(!empty($_POST["docid"])){
                                $docid=$_POST["docid"];
                                $gelmeyen = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 3 AND docid = $docid");
                                $row1 = $gelmeyen->fetch_assoc();
                                $count = $row1['count'];

                                $tamamlanan = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 4 AND docid = $docid");
                                $row2 = $tamamlanan->fetch_assoc();
                                $coun = $row2['count'];

                                $iptal = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 0  AND docid = $docid");
                                $row3 = $iptal->fetch_assoc();
                                $count2 = $row3['count'];

                                
                                $iptal1 = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 2 AND docid = $docid");
                                $row31= $iptal1->fetch_assoc();
                                $count2 += $row31['count'];

                                $aktif = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 1 AND docid = $docid");
                                $row4 = $aktif->fetch_assoc();
                                $count3 = $row4['count'];
                                //$sqlpt2=" doktor.docid=$docid ";
                            }
                            //echo $sqlpt2;
                            //echo $sqlpt1;
                          /*  $sqlmain= "select randevu.appoid,takvim.scheduleid,takvim.title,doktor.docname,hasta.pname,takvim.scheduledate,takvim.scheduletime,randevu.apponum,randevu.appodate from takvim inner join randevu on takvim.scheduleid=randevu.scheduleid inner join hasta on hasta.pid=randevu.pid inner join doktor on takvim.docid=doktor.docid";
                            $sqllist=array($sqlpt1,$sqlpt2);
                            $sqlkeywords=array(" where "," and ");
                            $key2=0;
                            foreach($sqllist as $key){
    
                                if(!empty($key)){
                                    $sqlmain.=$sqlkeywords[$key2].$key;
                                    $key2++;
                                };
                            };*/
                            //echo $sqlmain;
    
                            
                            
                            //
                        }else{
                            $gelmeyen = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 3");
                            $row1 = $gelmeyen->fetch_assoc();
                            $count = $row1['count'];

                            $tamamlanan = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 4");
                            $row2 = $tamamlanan->fetch_assoc();
                            $coun = $row2['count'];

                            $iptal = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 0");
                            $row3 = $iptal->fetch_assoc();
                            $count2 = $row3['count'];

                            $aktif = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 1");
                            $row4 = $aktif->fetch_assoc();
                            $count3 = $row4['count'];

                    }
                ?>     
            </table>
            <div>
        <?php 

        
        
        
        ?>
    <canvas id="myChart" width="600" height="600"></canvas>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Tamamlan Hasta', 'Gelmeyen Hasta', 'İptal Edilen Randevu','Aktif Randevular'],
            datasets: [{
                data: [<?php echo $coun?>, <?php echo $count?>, <?php echo $count2?>,<?php echo $count3?>],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(10, 255, 100)'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        }
    });
</script>


            
        </div>
</div>

</body>
</html>