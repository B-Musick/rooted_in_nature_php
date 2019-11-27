<?php
// Get all the plants
     // Headers
     header('Access-Control-Allow-Origin: *'); // Allow anyone to access
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: POST'); // Allowed requests
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods
     ,Content-Type, Authorization, X-Requested-With'); // Allowed headers (X-Requested-With = prevent XSS)

     include_once "../../config/Database.php";
     include_once "../../models/Plant.php";

     // Instantiate the DB and connect it
     $database = new Database();
     $db = $database->connect(); // PDO connects with host, user, password, database name

     // Instantiate Plant object, pass in the database to SELECT plants

     $plant = new Plant($db);

     // Plant query
     $result = $plant->showAll();

     // Get row count, if num >0 then there are plants
     $num = $result->rowCount();

     if($num>0){
         // If there are plants in the DB
         $plants_arr = array();
         $plants_arr['data'] = array();

         while($row = $result->fetch(PDO::FETCH_ASSOC)){
             // Want to extract values
             extract($row);

             $plant_item = array(
                'id' => $id,
                'genus' => $genus,
                'species' => $species,
                'family' => $family,
                'image' => $image,
                'leaf_type' => $leaf_type,
                'petal_count' => $petal_count,
                'sepal_count' => $sepal_count,
                'leaf_orientation' => $leaf_orientation,
                'date_added' => $date_added,
                'province' => $province,
                'city' => $city,
                'longitude' => $longitude,
                'latitude' => $latitude
             );
             array_push($plants_arr['data'], $plant_item);
            }
                // Turn to JSON & output
                echo json_encode($plants_arr);

        }else{
            // No Plants (num===0)
            echo json_encode(
            array('message' => 'No Posts Found')
        );
        }

    