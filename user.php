<?php

    class user {
        public $email;
        public $name;
        public $password;
        public $isAdmin;
        public $isVerified;
        public $verification_token;
        
        public function __construct($email, $name, $password, $isAdmin, $isVerified, $verification_token) {
            $this->email = $email;
            $this->name = $name;
            $this->password = $password;
            $this->isAdmin = $isAdmin;
            $this->isVerified = $isVerified;
            $this->verification_token = $verification_token;

        }

        public function insert($conn) {
            $name = $this->name;
            $email = $this->email;
            $password = $this->password;
            try {
                $sql = "INSERT INTO users (name, email, password,isAdmin,isVerified,verification_token) VALUES (:name, :email, :password ,0,0,0)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                echo "User inserted successfully.<br>";
            } catch (PDOException $e) {
                echo "Error inserting user: " . $e->getMessage() . "<br>";
            }
        }

        public function verify($conn, $token) {
            try {
                $sql = "SELECT * FROM users WHERE verification_token = :token";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':token', $token);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    $sql = "UPDATE users SET isVerified = 1 WHERE verification_token = :token";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':token', $token);
                    $stmt->execute();
                    echo "User verified successfully.<br>";
                } else {
                    echo "User verification failed.<br>";
                }
            } catch (PDOException $e) {
                echo "Error verifying user: " . $e->getMessage() . "<br>";
            }
        }
    }

?>