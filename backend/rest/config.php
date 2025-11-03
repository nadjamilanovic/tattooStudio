<?php
class Database {
   private static $host = 'localhost';
   private static $dbName = 'tattooStudio'; 
   private static $username = 'root';         
   private static $password = 'NovaLozinka123!';             
   private static $connection = null;

   public static function connect() {
       if (self::$connection === null) {
           try {
               self::$connection = new PDO(
                   "mysql:host=" . self::$host . ";dbname=" . self::$dbName,
                   self::$username,
                   self::$password,
                   [
                       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                   ]
               );
               echo "Connected successfully";
           } catch (PDOException $e) {
               die("Connection failed: " . $e->getMessage());
           }
       }
       return self::$connection;
   }
}
?>
