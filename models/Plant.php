<?php
    class Plant{

        // Database properties
        private $conn;
        private $table = 'plants';

        // Plant properties
        public $id;
        public $genus;
        public $species;
        public $family;
        public $image;
        public $leaf_type;
        public $petal_count;
        public $sepal_count;
        public $leaf_orientation;
        public $date_added;
        public $province;
        public $city;
        public $longitude;
        public $latitude;
        

        // Constructor - runs automatically on instantiation
        public function __construct($db){
            // Pass in database object, set connection to db
            $this->conn = $db;
        }

        // SELECT Plants
        public function showAll() {
            // Create query
            // Select name from categories
            // Assign plant as p in FROM
            // Define locations as l in LEFT JOIN
            $query = 'SELECT * FROM ' . $this->table;
            //LEFT JOIN locations l ON p.id = l.plant_id
            // 'ORDER BY date_added DESC'
            // Prepare SELECT statement
            $stmt = $this->conn->prepare($query);
            
            //Execute query
            $stmt->execute();
            return $stmt;
        }

        public function show(){
            $query = 'SELECT * FROM ' . $this->table . ' p WHERE p.id = ? LIMIT 0,1';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID (to ?)
            // Positional parameter
            $stmt->bindParam(1,$this->id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties
            $this->genus = $row['genus'];
            $this->species = $row['species'];
            $this->family = $row['family'];
            $this->image = $row['image'];
            $this->leaf_type = $row['leaf_type'];
            $this->petal_count = $row['petal_count'];
            $this->sepal_count = $row['sepal_count'];
            $this->leaf_orientation = $row['leaf_orientation'];
            $this->date_added = $row['date_added'];
            $this->province = $row['province'];
            $this->city = $row['city'];
            $this->longitude = $row['longitude'];
            $this->latitude = $row['latitude'];

        }

        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . ' SET genus = :genus, species = :species, family = :family, leaf_type = :leaf_type';
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            // Clean data
            // Dont want any html characters
            // Also dont want any tages
            // This is sanitizing the data for security
            $this->genus = htmlspecialchars(strip_tags($this->genus));
            $this->species = htmlspecialchars(strip_tags($this->species));
            $this->family = htmlspecialchars(strip_tags($this->family));
            $this->leaf_type = htmlspecialchars(strip_tags($this->leaf_type));
            // Bind data (using named parameters (:) instead of question marks)
            $stmt->bindParam(':genus', $this->genus);
            $stmt->bindParam(':species', $this->species);
            $stmt->bindParam(':family', $this->family);
            $stmt->bindParam(':leaf_type', $this->leaf_type);
            // Execute query. dont need to return value since inserting value
            if($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
          
    }