<?php
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
    $result = $plant->show();

    // Get ID
    // See if value is set
    // something.com?id=3 --> $_GET will retrieve this
    // Only need id since SELECT only chooses based on id
    $plant->id = isset($_GET['id']) ? $_GET['id'] : die();
    // Get plant based off matching id
    $plant->show();
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

    // Make JSON
    print_r(json_encode($plant_arr));