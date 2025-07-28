<?php

class Database{

    private static $dbHost = "localhost";
    private static $dbName = "burger";
    private static $dbUser = "root";
    private static $password = "4Nio/OtNGemHSkm!";
    private static $connection = null;

    public static function connect(){
        try{
            self::$connection = new PDO("mysql:host=". self::$dbHost . ";dbname=" . self::$dbName,self::$dbUser,self::$password);
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
        return self::$connection;
    }
    
    public static function disconnect(){
        self::$connection = null;
    }

}

Database::connect();



?>