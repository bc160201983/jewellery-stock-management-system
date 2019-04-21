<?php require_once 'inc/core.php'; ?>
<?php

$messages = array();

if (isset($_GET['id'])) {

  $p_id = $_GET['id'];

  $sql = "SELECT * FROM `products` WHERE product_id = $p_id";
  $result_products = mysqli_query($connection, $sql);
  confirm_query($result_products);
  while ($row = mysqli_fetch_assoc($result_products)) {
    $product_id = $row['product_id'];
    $product_name = $row['product_name'];
    $product_image = $row['product_image'];
    $p_categories_id = $row['categories_id'];
    $product_quantity = $row['quantity'];
    $product_weight = $row['weight'];
    $product_status = $row['active'];

  }
}

if (isset($_POST['updateProduct'])) {
  $productName = mysqli_real_escape_string($connection,$_POST['productName']);
  $p_image =$_FILES['image']['name'];
  $image_temp = $_FILES['image']['tmp_name'];
  $productCategory = mysqli_real_escape_string($connection,$_POST['productCategory']);
  $productQty = mysqli_real_escape_string($connection,$_POST['productQty']);
  $productWeight = (float)$_POST['productWeight'];
  $totalWeight = $productQty * $productWeight;
  $productStatus = mysqli_real_escape_string($connection,$_POST['product_status']);
    // echo $productName . "<br>";
    // echo $p_image . "<br>";
    // echo $productCategory . "<br>";
    // echo $productQty . "<br>";
    // echo $productWeight . "<br>";

    move_uploaded_file($image_temp, "./images/$p_image");
    if(empty($p_image)){
      $query = "SELECT * FROM `products` WHERE product_id = $p_id";
      $image_query = mysqli_query($connection, $query);
      while ($row = mysqli_fetch_assoc($image_query)) {
        $p_image = $row['product_image'];
      }}

  $sql = "UPDATE `products` SET product_name = '$productName', product_image = '$p_image', categories_id = $productCategory, quantity = $productQty, weight = $productWeight, total_weight = $totalWeight, active = $productStatus WHERE product_id = $p_id";
      $results = mysqli_query($connection,$sql);
      if(confirm_query($results)){
        $messages[] = "New Product Update successfully";
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
        <h3 class="card-title">Edit Product</h3>
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
                        <input value="<?php echo $product_name ?>" name="productName" type="text" class="form-control" placeholder="Add Product Name" required>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">           
                      <div class="form-group">
                        <div class="form-label">Product Image</div>
                        <img width='100' src="./images/<?php echo $product_image ?>" alt="">
                        <div>
                          <!-- class="custom-file-input" -->
                          <input type="file" name="image">
                          <!-- <label class="custom-file-label"></label> -->
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

                            if($cat_id ==  $p_categories_id){

                              echo "<option value='$cat_id' selected>$cat_title</option>";
                            }else{
                              echo "<option value='$cat_id'>$cat_title</option>";
                            }

                            
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
                        <input value="<?php echo $product_quantity ?>" name="productQty" type="number" class="form-control" placeholder="Product Quantity" required>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label">Weight(Grams)</label>
                        <input min="0" value="<?php echo $product_weight ?>" step="0.001" name="productWeight" type="number" class="form-control" placeholder="Product Weight" required>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Product Status</label>
                        <select class="form-control custom-select" name="product_status">
                          <!-- <option value="1">Active</option>
                            <option value="2">Inactive</option> -->
                            <?php
                            if ($product_status == 1) {
                              echo '<option value="1" selected>Active</option>';
                              echo '<option value="2">Inactive</option>';
                            }else{
                              echo '<option value="1">Active</option>';
                              echo '<option value="2" selected>In Active</option>';
                            }
                            ?>

                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button name="updateProduct" type="submit" class="btn btn-primary">Update Product</button>
                  </div>
                </form>

              </div>
