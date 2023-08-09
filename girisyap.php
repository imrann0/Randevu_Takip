<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/login.css">
        
    <title>Giriş</title>

    
    
</head>
<body>
    <?php


    session_start();

    $_SESSION["user"]="";
    $_SESSION["kullanicitipi"]="";
    
    // Set the new timezone
    date_default_timezone_set('Europe/Istanbul');
    $date = date('d-m-y');

    $_SESSION["date"]=$date;
    

    //import database
    include("baglanti.php");

    



    if($_POST){

        $email=$_POST['useremail'];
        $password=$_POST['userpassword'];
        
        $error='<label for="promter" class="form-label"></label>';

        $result= $database->query("select * from webkullanici where email='$email'");
        if($result->num_rows==1){
            $utype=$result->fetch_assoc()['kullanicitipi'];
            if ($utype=='p'){
                $checker = $database->query("select * from hasta where pemail='$email' and ppassword='$password'");
                if ($checker->num_rows==1){


                    //   hasta sayfası
                    $_SESSION['user']=$email;
                    $_SESSION['kullanicitipi']='p';

                    $stmt = $database->prepare("SELECT pid FROM hasta WHERE pemail = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $kullanici_id = $row['pid'];
                    $ip_adresi = $_SERVER['REMOTE_ADDR'];
                    $tarayici = $_SERVER['HTTP_USER_AGENT'];
                    $giris_tarihi = date('Y-m-d H:i:s');
                    $stmt = $database->prepare("INSERT INTO kullanici_log (kullanici_id, giris_tarihi, ip_adresi, tarayici) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$kullanici_id, $giris_tarihi, $ip_adresi, $tarayici]);

                    

                    header('location: hasta/index.php');

                }else{
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }

            }elseif($utype=='a'){
                $checker = $database->query("select * from admin where aeposta='$email' and asifre='$password'");
                if ($checker->num_rows==1){


                    //   Admin dashbord
                    $_SESSION['user']=$email;
                    $_SESSION['kullanicitipi']='a';
                    
                    header('location: admin/index.php');

                }else{
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }


            }elseif($utype=='d'){
                $checker = $database->query("select * from doktor where docemail='$email' and docpassword='$password'");
                if ($checker->num_rows==1){


                    //   doktor dashbord
                    $_SESSION['user']=$email;
                    $_SESSION['kullanicitipi']='d';
                    header('location: doktor/index.php');

                }else{
                    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }

            }
            
        }else{
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';
        }






        
    }else{
        $error='<label for="promter" class="form-label">&nbsp;</label>';
    }



    ?>





    <center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Hoşgeldiniz!</p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">Devam etmek için bilgilerinizle giriş yapın</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td">
                    <label for="useremail" class="form-label">E-posta: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="email" name="useremail" class="input-text" placeholder="E-posta" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="userpassword" class="form-label">Şifre: </label>
                </td>
            </tr>

            <tr>
                <td class="label-td">
                    <input type="Password" name="userpassword" class="input-text" placeholder="Sifre" required>
                </td>
            </tr>


            <tr>
                <td><br>
                <?php echo $error ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Giriş yap" style="background-color:light blue;" class="login-btn btn-primary btn">
                </td>
            </tr>
        </div>
            <tr>
                <td>
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;" >Hesabınız yok mu&#63; </label>
                    <a href="kayitol.php" class="hover-link1 non-style-link">Kayıt Ol</a>
                    <br><br><br>
                </td>
            </tr>
                        
                        
    
                        
                    </form>
        </table>

    </div>
</center>
</body>
</html>