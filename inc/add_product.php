<?php require_once 'inc/core.php'; ?>
<?php

$messages = array();

if (isset($_POST['addProduct'])) {
  $productName = $_POST['productName'];
  $image =$_FILES['image']['name'];
  $image_temp = $_FILES['image']['tmp_name'];
  $productCategory = $_POST['productCategory'];
  $productQty = $_POST['productQty'];
  $productWeight = (float)$_POST['productWeight'];
  $productStatus = $_POST['product_status'];

  if (empty($productName) || empty($image) || empty($productCategory) || empty($productQty) || empty($productWeight)) {
      $messages[] = "Please fill The required Fileds";
  }else{
    // echo $productName . "<br>";
    // echo $productCategory . "<br>";
    // echo $productQty . "<br>";
    // echo $productWeight . "<br>";
    // $total = $productWeight+$productWeight;
    // echo $total;
    if (isset($image)) {
      move_uploaded_file($image_temp, "./images/$image");
    }
    
    $sql = "INSERT INTO `products` (product_name, product_image, categories_id, quantity, weight, active) VALUES('$productName', '$image', $productCategory, $productQty, $productWeight, $productStatus)";
    $results = mysqli_query($connection,$sql);
    if(confirm_query($results)){
      $messages[] = "New Product Added successfully";
    }

  }




}

?>

<div class="col-lg-8" style="margin: auto; margin-top: 20px;">
                <?php
                  if ($messages) {
                    foreach ($messages as $key => $value) {
                      echo '<div class="alert alert-success"><strong>' . $value .'</strong></div>';
                    }
                  }

                ?>
              <form class="card" method="post" action="" enctype="multipart/form-data">
                <div class="card-body">
                  <h3 class="card-title">Add Product</h3>
                  <div class="row">
                    <!-- <div class="col-md-5">
                      <div class="form-group">
                        <label class="form-label">Company</label>
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="Creative Code Inc.">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" placeholder="Username" value="michael23">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" placeholder="Email">
                      </div>
                    </div> -->
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="form-label">Product Name</label>
                        <input name="productName" type="text" class="form-control" placeholder="Add Product Name" required>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">           
                      <div class="form-group">
                        <div class="form-label">Product Image</div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="image">
                          <label class="custom-file-label"></label>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Categories</label>
                        <select name="productCategory" class="form-control custom-select" required>
                          <option value="">~~Select~~</option>
                          <?php
                          $results = get_all_categories();
                          while ($row = mysqli_fetch_assoc($results)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "<option value='$cat_id'>$cat_title</option>";
                          }
                          ?>
                          <!-- <option value="">~~Select~~</option> -->
                          <<!-- option value="">Germany</option>
                          <option value="">Germany</option>
                          <option value="">Germany</option> -->
                        </select>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="form-label">Quantity</label>
                        <input id="productQty" name="productQty" type="number" class="form-control" placeholder="Product Quantity" required>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label">Weight (Grams)</label>
                        <input oninput="showTotalWeight()" id="weight" min="0" value="0" step="0.001" name="productWeight" type="number" class="form-control" placeholder="Product Weight" required>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Product Status</label>
                        <select class="form-control custom-select" name="product_status">
                          <option value="1">Active</option>
                          <option value="2">In Active</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <p id="totalPWeight"></p>
                      <!-- <div class="form-group">
                        <label class="form-label">Total Weight</label>
                        <input id="totalPWeight" name="totalWeight" type="text" class="form-control" placeholder="Product Total Weight" readonly>
                      </div> -->
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button name="addProduct" type="submit" class="btn btn-primary">Add Product</button>
                </div>
              </form>
<p id="foo"></p>
            </div>

<!-- <script type="text/javascript">
  
define(|'jquery'|, function($){
  $('#foo').text('[text changed]');
});

</script> -->

