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
        .chart-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-30%, -50%);
            margin-top:20px;
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
                    <td style="padding:20px" colspan="2">
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
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Hasta Bilgi Grafiği</p>
                                           
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
                                $gelmeyen = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 3 AND docid = $docid AND bitis > '$tarih'");
                                $row1 = $gelmeyen->fetch_assoc();
                                $count = $row1['count'];
                            }
    
    
                            $sqlpt2="";
                            if(!empty($_POST["docid"])){
                                $docid=$_POST["docid"];
                                $gelmeyen = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 3 AND docid = $docid");
                                $row1 = $gelmeyen->fetch_assoc();
                                $count = $row1['count'];

                                $tamamlanan = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 4 AND docid = $docid");
                                $row2 = $tamamlanan->fetch_assoc();
                                $coun = $row2['count'];

                                $iptal = $database->query("SELECT COUNT(*) as count FROM randevu WHERE rndurum = 0 or rndurum = 2 AND docid = $docid");
                                $row3 = $iptal->fetch_assoc();
                                $count2 = $row3['count'];

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
                            $erkek10 = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'E' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 0 AND 9");
                            $row1 = $erkek10->fetch_assoc();
                            $erkek1 = $row1['count'];

                            $erkek10 = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'E' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 10 AND 19");
                            $row1 = $erkek10->fetch_assoc();
                            $erkek2 = $row1['count'];

                            $erkek10 = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'E' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 20 AND 29");
                            $row1 = $erkek10->fetch_assoc();
                            $erkek3 = $row1['count'];

                            $erkek10 = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'E' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 30 AND 39");
                            $row1 = $erkek10->fetch_assoc();
                            $erkek4 = $row1['count'];

                            $erkek10 = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'E' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 40 AND 49");
                            $row1 = $erkek10->fetch_assoc();
                            $erkek5 = $row1['count'];

                            $erkek10 = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'E' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 50 AND 59");
                            $row1 = $erkek10->fetch_assoc();
                            $erkek6 = $row1['count'];

                            $erkek10 = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'E' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 60 AND 69");
                            $row1 = $erkek10->fetch_assoc();
                            $erkek7 = $row1['count'];

                            $erkek10 = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'E' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 70 AND 79");
                            $row1 = $erkek10->fetch_assoc();
                            $erkek8 = $row1['count'];

                            $erkek10 = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'E' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 80 AND 90");
                            $row1 = $erkek10->fetch_assoc();
                            $erkek9 = $row1['count'];

                            // Kadın ------------------------

                            $kadin = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'K' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 0 AND 9");
                            $row2 = $kadin->fetch_assoc();
                            $kadin1 = $row2['count'];

                            $kadin = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'K' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 10 AND 19");
                            $row2 = $kadin->fetch_assoc();
                            $kadin2 = $row2['count'];

                            $kadin = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'K' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 20 AND 29");
                            $row2 = $kadin->fetch_assoc();
                            $kadin3 = $row2['count'];

                            $kadin = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'K' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 30 AND 39");
                            $row2 = $kadin->fetch_assoc();
                            $kadin4 = $row2['count'];

                            $kadin = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'K' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 40 AND 49");
                            $row2 = $kadin->fetch_assoc();
                            $kadin5 = $row2['count'];

                            $kadin = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'K' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 50 AND 59");
                            $row2 = $kadin->fetch_assoc();
                            $kadin6 = $row2['count'];

                            $kadin = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'K' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 60 AND 69");
                            $row2 = $kadin->fetch_assoc();
                            $kadin7 = $row2['count'];

                            $kadin = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'K' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 70 AND 79");
                            $row2 = $kadin->fetch_assoc();
                            $kadin8 = $row2['count'];

                            $kadin = $database->query("SELECT COUNT(*) as count FROM hasta WHERE cinsiyet = 'K' AND TIMESTAMPDIFF(YEAR, pdob, CURDATE()) BETWEEN 80 AND 90");
                            $row2 = $kadin->fetch_assoc();
                            $kadin9 = $row2['count'];
                    }
                ?>     
            </table>
            <div>
        <?php 

        
        
        
        ?>
  <div class="chart-container">
  <!-- <canvas id="myChart" width="300" height="300"></canvas> -->
  <canvas id="ageChart" width="700" height="600"></canvas>
</div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   <!-- <script>
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['ERKEK','KADIN'],
                datasets: [{
                    data: [],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)'

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
                    }
                }
            }
        });
    </script>-->

    <script>
  const ageCtx = document.getElementById('ageChart');
  const maleData = [<?php echo $erkek1?>, <?php echo $erkek2?>, <?php echo $erkek3?>, <?php echo $erkek4?>, <?php echo $erkek5?>, <?php echo $erkek6?>, <?php echo $erkek7?>, <?php echo $erkek8?>, <?php echo $erkek9?>];
  const femaleData = [<?php echo $kadin1?>, <?php echo $kadin2?>, <?php echo $kadin3?>, <?php echo $kadin4?>, <?php echo $kadin5?>, <?php echo $kadin6?>, <?php echo $kadin7?>, <?php echo $kadin8?>, <?php echo $kadin9?>];
  const ageChart = new Chart(ageCtx, {
    type: 'bar',
    data: {
      labels: ['0-9', '10-19', '20-29', '30-39', '40-49', '50-59', '60-69', '70-79', '80-90'],
      datasets: [
        {
          label: 'Erkekler',
          data: maleData,
          backgroundColor: 'rgba(54, 162, 235, 0.4)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        },
        {
          label: 'Kadınlar',
          data: femaleData,
          backgroundColor: 'rgba(255, 99, 132, 0.4)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      responsive: false,
      plugins: {
        title: {
          display: true,
          text: 'Cinsiyete Göre Yaş Dağılımı'
        }
      },
      animation: {
        duration: 2000,
        easing: 'easeOutElastic'
      }
    }
  });
</script>



            
        </div>
</div>

</body>
</html>