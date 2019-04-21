      <p id="show"></p>
      <div class="col-10" style="margin: auto; margin-top: 20px;">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Manage Products</h3>
                    <form style="width: 50%; margin-left: auto;" method="post" action="getProductByCatId.php">
                    <select id="category" name="productCategory" class="form-control custom-select">
                          <option value="">~~Select~~</option>
                          <?php
                          $results = get_all_categories();
                          while ($row = mysqli_fetch_assoc($results)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "<option id='categoryVal' value='$cat_id'>$cat_title</option>";
                          }
                          ?>
                          <!-- <option value="">~~Select~~</option> -->
                          <<!-- option value="">Germany</option>
                          <option value="">Germany</option>
                          <option value="">Germany</option> -->
                        </select>
                      </form>
                  </div>
                  <!-- class="table card-table table-vcenter text-nowrap" -->
                  <div class="table-responsive">
                    <table id="product_data" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="w-1">No.</th>
                          <th>Name</th>
                          <th>Image</th>
                          <th>Category</th>
                          <th>Quantity</th>
                          <th>Weight</th>
                          <th>Status</th>
                          <th>Action</th>
                        
                        </tr>
                      </thead>
                      <tbody>

                          <?php

                            $sql = "SELECT * FROM `products`";
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
                            

                          ?>
                        <tr>
                          <td><span class="text-muted"><?php echo $product_id; ?></span></td>
                          <td><?php echo $product_name; ?></td>
                          <td class="w-1"><span class="avatar" style="background-image: url(./images/<?php echo $product_image; ?>)"></span></td>
                          <td>
                            <?php

                              $cat_result = get_cat_by_id($p_categories_id);
                              while ($row = mysqli_fetch_assoc($cat_result)) {
                                $cat_title = $row['cat_title'];
                                echo $cat_title;
                              }

                            ?>
                          </td>
                          <td>
                            <?php echo $product_quantity; ?>
                          </td>
                          <td>
                            <?php echo $product_weight; ?>
                          </td>
                          <td>
                            <?php
                              if ($product_status == 1) {
                                echo '<span class="status-icon bg-success"></span>Active';
                              }else{
                                echo '<span class="status-icon bg-danger"></span>In Active';
                              }
                            ?>
                            
                          </td>

                          <td class="text-center">
                            <a href="products.php?s=edit_product&id=<?php echo $product_id ?>" class="btn btn-secondary btn-sm">Edit</a>
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Delete</a>
                          </td>
                        <!--   <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td> -->
                        </tr>
                      <?php } ?>
                        <!-- <tr> -->
                         <!--  <td><span class="text-muted">001404</span></td>
                          <td><a href="invoice.html" class="text-inherit">Landing Page</a></td>
                          <td>
                            Salesforce
                          </td>
                          <td>
                            87953421
                          </td>
                          <td>
                            2 Sep 2017
                          </td>
                          <td>
                            <span class="status-icon bg-secondary"></span> Due in 2 Weeks
                          </td>
                          <td class="text-right">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm">Manage</a>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown">Actions</button>
                            </div>
                          </td>
                          <td>
                            <a class="icon" href="javascript:void(0)">
                              <i class="fe fe-edit"></i>
                            </a>
                          </td>
                        </tr> -->
             
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          


<script type="text/javascript">

  // $(document).ready(function(){
  //     $('#product_data').DataTable();
  // });

$(document).ready(function(){
      $('#category').change(function(){
          var cat_id = $('#category').val();
          console.log(cat_id);

          if(cat_id != ""){
              $.ajax({
              type: 'post',
              url: 'inc/getProductByCatId.php',
              data:{cat_id:cat_id},
              datatype: 'json',
              success:function(data){
                //var parseData = JSON.parse(data);
                $('#show').text(data);
              }

          }); 

          }else{

            console.log("Please select a category");

          }
         
          
      });
  });


</script>