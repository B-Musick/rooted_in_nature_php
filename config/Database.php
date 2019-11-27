<?php
    class Database{
        // Parameters for the connection
        private $host = 'localhost';
        private $db_name = 'rootedinnature';
        private $username = 'root';
        private $password = '#Kernal23';
        private $conn;

        public function connect(){
            $this->conn = null;

            try{
                $this->conn = new PDO("mysql:host=" . $this->host .
                    ";dbname=" . $this->db_name, 
                    $this->username, $this->password);
                // Want to get exceptions when make queries, so if error occurs
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            } 
            return $this->conn; // Return the connection to be used in models
        }
    }