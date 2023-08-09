<?php
if(isset($_POST['randevu_al'])){

                                                            
    $sql = "SELECT * FROM randevu WHERE pid = $userid";
    $res = $database->query($sql);
    $takvim_docid = $docid;
    while ($row = $res->fetch_assoc()) {
        $randevu_docid = $row["docid"];
      
        
        if ($randevu_docid == $takvim_docid) {
          echo "Bu doktordan zaten bir randevunuz var!";
          exit;
        }
    }
    }


    require_once __DIR__ . '/vendor/autoload.php';
?>