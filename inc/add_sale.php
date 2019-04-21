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
            <div class="col-lg-12">
              <form class="card">
                <div class="card-body">
                  <h3 class="card-title">Add Sale</h3>
                  <div class="row">
                    
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Client Name</label>
                        <input name="clientName" type="text" class="form-control" placeholder="Company" value="Chet">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label">Date</label>
                        <input name="orderDate" type="date" class="form-control" placeholder="Last Name" value="Faker">
                      </div>
                    </div>
                    <div class="col-md-12">
<table class="table" id="productTable">
          <thead>
            <tr>              
              <th style="width:40%;">Product</th>
              <th style="width:20%;">Rate</th>
              <th style="width:15%;">Quantity</th>              
              <th style="width:15%;">Total</th>             
              <th style="width:10%;"></th>
            </tr>
          </thead>
          <tbody>
                          <tr id="row1" class="2">                
                <td style="margin-left:20px;">
                  <div class="form-group">

                  <select class="form-control" name="productName[]" id="productName" onchange="getProductData()">
                    <option value="">~~SELECT~~</option>
                    
              Notice:  Undefined index: product


              _id in C:\xampp\htdocs\stock\orders.php on line 110
              <option value="7" id="changeProduct">Half Pant</option>
              Notice:  Undefined index: product


              _id in C:\xampp\htdocs\stock\orders.php on line 110
              <option value="9" id="changeProduct">Ring</option>                  
              </select>
                  </div>
                </td>
                <td style="padding-left:20px;">                 
                  <input type="text" name="rate[]" id="rate3" autocomplete="off" disabled="true" class="form-control">                  
                  <input type="hidden" name="rateValue[]" id="rateValue3" autocomplete="off" class="form-control">                  
                </td>
                <td style="padding-left:20px;">
                  <div class="form-group">
                  <input type="number" name="quantity[]" id="quantity" onkeyup="getTotal(3)" autocomplete="off" class="form-control" min="1">
                  </div>
                </td>
                <td style="padding-left:20px;">                 
                  <input type="text" name="total[]" id="total3" autocomplete="off" class="form-control" disabled="true">                  
                  <input type="hidden" name="totalValue[]" id="totalValue3" autocomplete="off" class="form-control">                  
                </td>
                <td>

                  <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(3)"><i class="fa fa-plus fa-5x"></i></button>
                </td>
              </tr>
                      </tbody>          
        </table>





                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" placeholder="City" value="Melbourne">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <div class="form-group">
                        <label class="form-label">Postal Code</label>
                        <input type="number" class="form-control" placeholder="ZIP Code">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label class="form-label">Country</label>
                        <select class="form-control custom-select">
                          <option value="">Germany</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group mb-0">
                        <label class="form-label">About Me</label>
                        <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike">Oh so, your weak rhyme
You doubt I'll bother, reading into it
I'll probably won't, left to my own devices
But that's the difference in our opinions.</textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
              </form>


            </div>


