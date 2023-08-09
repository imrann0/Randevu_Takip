
    <?php
    
    

    //veri tabanı çekimi
    include("../baglanti.php");



    if($_POST){
        $result= $database->query("select * from webkullanici");
        $name=$_POST['name'];
        $nic=$_POST['nic'];
        $oldemail=$_POST["oldemail"];
        $spec=$_POST['spec'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
        $zaman=$_POST['zaman'];
        
        if ($password==$cpassword){
            $error='3';
            $result= $database->query("select doktor.docid from doktor inner join webkullanici on doktor.docemail=webkullanici.email where webkullanici.email='$email';");
            
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["docid"];
            }else{
                $id2=$id;
            }
            
            echo $id2."jdfjdfdh";
            if($id2!=$id){
                $error='1';               
                    
            }else{

                
                $sql1="update doktor set docemail='$email',docname='$name',docpassword='$password',docnic='$nic',doctel='$tele',specialties=$spec,zaman='$zaman' where docid=$id ;";
                $database->query($sql1);
                
                $sql1="update webkullanici set email='$email' where email='$oldemail' ;";
                $database->query($sql1);
            
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
     
        $error='3';
    }
    

    header("location: doktorlar.php?action=edit&error=".$error."&id=".$id);
    ?>
    
   

</body>
</html>