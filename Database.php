<?php
   class Database{
       private $host = "localhost";
       private $username = "root";
       private $password = "";
       private $database = "testa1";
       private $conn;



       public static $instance;
       public static function getInstance(){
           if(!self::$instance){
               self::$instance = new Database();
           }
           return self::$instance;
       }
      
       public function __construct(){
           try{
               // Tạo kết nối đến database theo phương thức PDO
               $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
               $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               // echo "Connect thành công";
           }catch(PDOException $e){
               echo "Connection failed: ".$e->getMessage();
           }
       }
       // Dùng cho câu lệnh SQL dạng INSERT, UPDATE hoặc DELETE
       public function execute($sql,$param = []){
           $stmt = $this->conn->prepare($sql);
           return $stmt->execute($param);
       }
       //Dùng cho câu lệnh SELECT
       public function getAll($sql){
           $stmt = $this->conn->prepare($sql);
           $stmt->execute();
           
           return $stmt->fetchAll(PDO::FETCH_ASSOC);;
       }

       public function getValue($sql, $params = []) {
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}


     public function getOne($sql, $params = []) {
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

       public function getConn(){
        return $this->conn;
    }
    public function getTotalshow() {
        $sql = "SELECT COUNT(id) AS total_show FROM transporter";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row["total_show"] : 0;
    }
    public function getTotalshow1() {
        $sql = "SELECT COUNT(id) AS total_show FROM suppliers";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row["total_show1"] : 0;
    }
    public function getTotalshow2() {
        $sql = "SELECT COUNT(id) AS total_show FROM events";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row["total_show2"] : 0;
    }
   }   
?>