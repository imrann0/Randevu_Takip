<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Sign Up</title>
    
</head>
<body>
<?php

//learn from w3schools.com
//Unset all the server side variables

session_start();

$_SESSION["user"]="";
$_SESSION["kullanicitipi"]="";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('d-m-y');

$_SESSION["date"]=$date;



if($_POST){

    

    $_SESSION["personal"]=array(
        'fname'=>$_POST['fname'],
        'lname'=>$_POST['lname'],
        'address'=>$_POST['address'],
        'nic'=>$_POST['nic'],
        'cinsiyet'=>$_POST['cinsiyet'], 
        'dob'=>$_POST['dob']
    );


    print_r($_SESSION["personal"]);
    header("location: hesap-olustur.php");




}

?>


    <center>
    <div class="container">
        <table border="0">
            <tr>
                <td colspan="2">
                    <p class="header-text">Kayıt</p>
                    <p class="sub-text">Blgilerinizi eksiksiz ve doğru giriniz. </p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td" colspan="2">
                    <label for="name" class="form-label">Ad: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="text" name="fname" class="input-text" placeholder="Ad" required>
                </td>
                <td class="label-td">
                    <input type="text" name="lname" class="input-text" placeholder="Soyad" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="address" class="form-label">Adres: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="address" class="input-text" placeholder="Addres" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="nic" class="form-label">Kimlik: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="nic" class="input-text" placeholder="Kimlik Numarası" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label class="form-label">Cinsiyet: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label>
                    <input type="radio" name="cinsiyet" value="K" checked> Kadın
                    </label>
                    <label>
                    <input type="radio" name="cinsiyet" value="E"> Erkek
                    </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="dob" class="form-label">Doğum Tarihi: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="date" name="dob" class="input-text" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                </td>
            </tr>

            <tr>
                <td>
                    <input type="reset" value="Sıfırla" class="login-btn btn-primary-soft btn" >
                </td>
                <td>
                    <input type="submit" value="Devam" class="login-btn btn-primary btn">
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Zaten hesabınız var mı&#63; </label>
                    <a href="girisyap.php" class="hover-link1 non-style-link">Giriş</a>
                    <br><br><br>
                </td>
            </tr>

                    </form>
            </tr>
        </table>

    </div>
</center>
</body>
</html>