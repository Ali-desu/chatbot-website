<?php 
    $servername = "localhost:4306";
    $username = "root";
    $password = "";
    $dbname = "chatbot";



    // Create connection class , we using pdo
    class connexion {
        public $conn;

        public function __construct($servername, $username, $password, $dbname) {
            try {
                $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully";
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }


        public function insertUser($user){
            return $user->insert($this->conn);
        }

        public function verifyUser($email, $pwd) {
            try {
                $sql = "SELECT * FROM users WHERE email = :email AND password = :pwd";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':pwd', $pwd);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result; // Returns user data if found, otherwise null
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return null; // Verification failed
            }
        }

        public function verifyToken($user,$token){
            return $user->verify($this->conn,$token);
        }
    }


?>