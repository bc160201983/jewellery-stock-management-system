<?php include'inc/header.php'; ?>
<body class="">
  <?php include('inc/navbar.php') ?>

  <?php
  if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    if (!empty($cat_title)) {
      insert_Categories($cat_title);
    }else{
      echo "please add some category";
    }

  }


  if (isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];
  }
  if(isset($_POST['update_category'])){
    $update_cat_title = mysqli_real_escape_string($connection, $_POST['cat_title']);
    if ($update_cat_title == "" || empty($update_cat_title)) {
      echo "Please Add Some Category";
    }else{

      $query = "UPDATE `categories` SET cat_title = '$update_cat_title' WHERE cat_id = $cat_id";
      $results = mysqli_query($connection, $query);
      if ($results) {
        echo "Updated";
        header("Location: category.php");
      }else{
        die("Failed" . mysqli_error($connection));
      }

    }
  }

//delete

  if (isset($_GET['delete'])) {
    $del_id = $_GET['delete'];
     $results = del_cat_by_id($del_id);
    if($results){
      echo "Record Deleted";
      header("Location: category.php");
    }
  }

  ?>
  <!-- add category -->
  <!-- style="margin: auto; margin-top: 20px;" -->
  <div class="container">
    <div class="row row-cards" style="margin-top: 20px;">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <?php
              if(isset($_GET['edit']) && $_GET['edit'] != ""){
                echo "Edit Category";
              }else{
                echo "Add New Category";
              }
              ?>

            </h3>
          </div>

          <?php
          if(isset($_GET['edit']) && $_GET['edit'] != ""){
            $cat_id = $_GET['edit'];
            $results = get_cat_by_id($cat_id);
            while ($row = mysqli_fetch_assoc($results)) {
              $cat_title = $row['cat_title'];
            }
          }
          ?>

          <div class="card-body">
            <form action="" method="post">
             <div class="input-group mb-3">
              <input name="cat_title" value="<?php if(isset($cat_title)) echo $cat_title; ?>" type="text" class="form-control" placeholder="Category Name" aria-label="Recipient's username" aria-describedby="button-addon2">
              <div class="input-group-append">
                <?php
                if (isset($_GET['edit'])) {
                  echo "<button class='btn btn-outline-primary' type='submit' id='button-addon2' name='update_category'>Update Category</button>";
                }else{
                  echo "<button class='btn btn-outline-primary' type='submit' id='button-addon2' name='submit'>Add Category</button>";
                }
                ?>



              </div>
            </form>
          </div>
        </div>





        <div>


        </div>


      </div>



    </div>






    <!-- show category -->

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Categories</h3>
        </div>
        <div class="card-body o-auto" style="height: 15rem">
         <div class="table-responsive">
          <table class="table card-table table-striped table-vcenter">
            <thead>
              <tr>
                <th colspan="0">ID</th>
                <th>Category Title</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $all_cat_results = get_all_categories();
              while ($row = mysqli_fetch_assoc($all_cat_results)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];



                ?>
                <tr>
                  <td class="text-muted"><?php echo $cat_id; ?></td>
                  <td><?php echo $cat_title; ?></td>
                  <td class="w-1"><a href="category.php?edit=<?php echo $cat_id; ?>" class="icon"><i class="fa fa-edit"></i></a></td>
                  <td class="w-1"><a href="category.php?delete=<?php echo $cat_id; ?>" class="icon"><i class="fe fe-trash"></i></a></td>
                </tr>

              <?php  } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('inc/footer.php') ?>