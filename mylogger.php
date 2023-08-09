<?php 

class myLogger
{
    const DB_HOST = 'localhost';
    const DB_NAME = 'randevukayit';
    const DB_USER = 'root';
    const DB_PASSWORD = '';

    static function insert($message, $patient_id = null){
        $pdo = new PDO("mysql:host=".self::DB_HOST.";dbname=".self::DB_NAME, self::DB_USER, self::DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $date = date("Y-m-d H:i:s");
        $text = $message;

        // If a patient_id is provided, include it in the log
        if($patient_id){
            $sql = "INSERT INTO hastalogs (pid, date, message) VALUES (:pid, :date, :text)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':pid', $patient_id);
        } else {
            $sql = "INSERT INTO hastalogs (date, message) VALUES (:date, :text)";
            $stmt = $pdo->prepare($sql);
        }

        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':text', $text);
        $stmt->execute();
    }
}



?>
