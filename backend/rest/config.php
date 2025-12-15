<?php
class Database {
    private static $host = 'localhost';
    private static $dbName = 'tattoo_studio';
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
            } catch (PDOException $e) {
                error_log("Database connection failed: " . $e->getMessage());
                die("Database connection failed."); 
            }
        }
        return self::$connection;
    }

    public static function JWT_SECRET() {
        return 'super-secret-key12345'; 
    }
}
?>
