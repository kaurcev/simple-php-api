<?php
class Database{
    // Хост базы данных
    private $host = "localhost";

    // Название базы данных
    private $db_name = "db_name";

    // Имя пользователя базы данных
    private $username = "root";

    // Пароль от пользователя базы данных
    private $password = "root";
    public $conn;
    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>