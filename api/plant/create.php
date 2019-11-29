<?php include "../../views/partials/header.html" ?>
  <div class="form-page">
    <div class="form-container">
      <form action="create.php" method="POST">
          <div class="form-item"><span class="form-item-title">Genus:</span> <span><input type="text" name="genus"><br></span></div>
          <div class="form-item"><span class="form-item-title">Species:</span>  <span><input type="text" name="species"><br></span></div>
          <div class="form-item"><span class="form-item-title">Family:</span>  <span><input type="text" name="family"><br></span></div>
          <div class="form-item"><span class="form-item-title">Image:</span>  <span><input type="text" name="leaf_type"><br></span></div>
          <input class="form-item" type="submit" name="submit" id="submit-button">
      </form>
    </div>
  </div>
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

  if(isset($_POST['submit']) && $plant->create() ) {
    // Make sure POST is submitted before creating
    // Had problem where it was creating empty post when first going to create page
      echo 'Post Created';
      echo 'Plant genus: ' . $plant->genus;

  } else {
    echo 'Post Not Created'; 
  }
?>

<?php include '../../views/partials/footer.html' ?>