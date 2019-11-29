<?php include '../../views/partials/header.html' ?>
<div id="search-container">
    <form action="search.php" method="POST">
        <input type="text" name="queryString">
        
        <input type="submit" name="search">
    </form>
</div>
<div id="search-results-container">
    <?php 
        include '../../config/Database.php'; 
        include '../../models/Plant.php'; 

        if(isset($_POST['search'])){
            $database = new Database();
            $db = $database->connect();

            $plant = new Plant($db);

            $plant->searchQuery = $_POST['queryString'];

            $result = $plant->search();

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

                echo '<div id="search-results"><table align="left" cellspacing="5" cellpadding="8">' .
                '<tr><th align="left"><b>Plant Genus</b></th>' .
                '<th align="left"><b>Plant Species</b></th>' .
                '<th align="left"><b>Plant Family</b></th>' .
                '<th align="left"><b>Plant ID</b></th>' .
                '<th align="left"><b>Leaf Type</b></th>';

                foreach($plants_arr['data'] as $plant){
                    echo '<tr><td align="left">' . 
                    $plant['genus'] . '</td><td align=""left">' . 
                    $plant['species'] . '</td><td align="left">' .
                    $plant['family'] . '</td><td align="left"><a href="/api/plant/show.php?id=' . $plant['id'] . '">' .
                    $plant['id'] . '</a></td><td align="left">' .
                    $plant['leaf_type'] . '</td>';
                }
                echo '</tr></table></div>';



            }else{
                // No Plants (num===0)
                echo json_encode(
                array('message' => 'No Posts Found')
            );
            }



        }



    ?>
</div>

<?php include '../../views/partials/footer.html' ?>

