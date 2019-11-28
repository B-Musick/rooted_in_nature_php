<?php 
    // Headers
    header('Access-Control-Allow-Origin: *'); // Allow anyone to access

    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include "../../config/Database.php";
    include "../../models/Plant.php";

    // Get the method which the server was accessed
    $method = $_SERVER['REQUEST_METHOD'];

    // Set up the databse
    $database = new Database();
    $db = $database->connect();
    
    // Instantiate a new plant object
    $plant = new Plant($db);

    // Get the id of the plant your updating (passed as parameter in the anchor on show page)
    $plant->id = $_GET['id'];

    if($method != 'POST'){
        // If just accessing this page from the show route to update, just show current values
        // Place values in the object
        $plant->show();
    }else{
        // If updated the instance
        // Parse the url into Array
        $url = parse_url(file_get_contents('php://input'));
        // Get the params into associative array
        parse_str($url['path'], $params);
        echo var_dump($params['genus']);

        // Set the values in the class Plant object
        $plant->id = $params['id'];
        $plant->genus = $params['genus'];
        $plant->species = $params['species'];
        $plant->family = $params['family'];
        $plant->leaf_type = $params['leaf_type'];

        // Update the plant with the new set values from the update form
        $plant->update();
        echo 'updated';
    }

    // Create array from plant data
    $plant_arr = array(
        'id' => $plant->id,
        'genus' => $plant->genus,
        'species' => $plant->species,
        'family' => $plant->family,
        'image' => $plant->image,
        'leaf_type' => $plant->leaf_type,
        'petal_count' => $plant->petal_count,
        'sepal_count' => $plant->sepal_count,
        'leaf_orientation' => $plant->leaf_orientation,
        'date_added' => $plant->date_added,
        'province' => $plant->province,
        'city' => $plant->city,
        'longitude' => $plant->longitude,
        'latitude' => $plant->latitude
    );

    // Print out the form with associated plant data
    echo '<form action="update.php" method="POST">
    Genus: <input type="text" name="genus" value=' . $plant_arr['genus'] . '><br>
    Species: <input type="text" name="species" value=' . $plant_arr['species'] . '><br>
    Family: <input type="text" name="family" value=' . $plant_arr['family'] . '><br>
    Leaf Type: <input type="text" name="leaf_type" value=' . $plant_arr['leaf_type'] . '><br>
    ID: <input type="int" name="id" value=' . $plant_arr['id'] . '><br>
    <input type="submit" name="update">
    </form>';
?>
