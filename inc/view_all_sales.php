      <div class="col-8" style="margin: auto; margin-top: 20px;">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Manage Products</h3>
                  </div>
                  <div class="table-responsive">
                    <table id="manageBrandTable" class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">No.</th>
                          <th>Name</th>
                          <th>Image</th>
                          <th>Category</th>
                          <th>Quantity</th>
                          <th>Weight</th>
                          <th>Total Weight<strong>(Grams)</strong></th>
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
                              $productsTotalWeight = $row['total_weight'];
                              $product_status = $row['active'];
                            

                          ?>
                        <tr>
                          <td><span class="text-muted"><?php echo $product_id; ?></span></td>
                          <td><a href="invoice.html" class="text-inherit"><?php echo $product_name; ?></a></td>
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
                          <td class="text-center">
                            <?php echo $productsTotalWeight; ?>
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
  <script type="text/javascript" src="./customs/custom.js"></script>