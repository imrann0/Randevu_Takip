
    <?php
    
    

    //import database
    include("../baglanti.php");



    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from webkullanici");
        $name=$_POST['name'];
        $nic=$_POST['nic'];
        $oldemail=$_POST["oldemail"];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';
            $aab="select hasta.pid from hasta inner join webkullanici on hasta.pemail=webkullanici.email where webkullanici.email='$email';";
            $result= $database->query($aab);
            //$resultqq= $database->query("select * from doktor where docid='$id';");
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["pid"];
            }else{
                $id2=$id;
            }
            

            if($id2!=$id){
                $error='1';
                //$resultqq1= $database->query("select * from doktor where docemail='$email';");
                //$did= $resultqq1->fetch_assoc()["docid"];
                //if($resultqq1->num_rows==1){
                    
            }else{

                //$sql1="insert into doktor(docemail,docname,docpassword,docnic,doctel,specialties) values('$email','$name','$password','$nic','$tele',$spec);";
                $sql1="update hasta set pemail='$email',pname='$name',ppassword='$password',pnic='$nic',ptel='$tele',paddress='$address' where pid=$id ;";
                $database->query($sql1);
                echo $sql1;
                $sql1="update webkullanici set email='$email' where email='$oldemail' ;";
                $database->query($sql1);
                echo $sql1;
                
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        
        $error='3';
    }
    

    header("location: ayarlar.php?action=edit&error=".$error."&id=".$id);
    ?>
    
   

</body>
</html>