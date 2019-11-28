<?php include "../../views/partials/header.html" ?>
    <form action="create.php" method="POST">
        Genus: <input type="text" name="genus"><br>
        Species: <input type="text" name="species"><br>
        Family: <input type="text" name="family"><br>
        Image: <input type="text" name="leaf_type"><br>
        <input type="submit" name="submit">
    </form>
<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
 
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  include_once '../../config/Database.php';
  include_once '../../models/Plant.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $plant = new Plant($db);

  if(isset($_POST['submit'])){
    $plant->genus = $_POST['genus'];
    $plant->species = $_POST['species'];
    $plant->family = $_POST['family'];
    $plant->leaf_type = $_POST['leaf_type'];
  
  }

  if($plant->create() && $plant->genus!=null) {
      echo 'Post Created';
      echo 'Plant genus: ' . $plant->genus;

  } else {
    echo 'Post Not Created'; 
  }
?>

<?php include '../../views/partials/footer.html' ?>