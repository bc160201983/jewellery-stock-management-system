<?php
require_once 'db.php';
require_once 'functions.php';

$data = array();

if(isset($_POST['cat_id'])){

$cat_id = $_POST['cat_id'];


			$sql = "SELECT * FROM `products` WHERE categories_id = '".$cat_id. "'";
      $result_products = mysqli_query($connection, $sql);
      confirm_query($result_products);

      while ($row = mysqli_fetch_assoc($result_products)) {
          $data['status'] = 'ok';
          $data['result'] = $row;

          echo json_encode($data);

      }
                           
    

                      
                         
}

?>