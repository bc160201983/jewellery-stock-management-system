<?php include'inc/header.php'; ?>
  <body class="">
      <?php include('inc/navbar.php') ?>

      <?php
      	if (isset($_GET['s'])) {
      		$source = $_GET['s'];

      		
      	}else{
      		$source = "";
      	}

      	switch ($source) {
      			case 'add_product':
      				include"inc/add_product.php";
      				break;
                        case 'edit_product':
                              include"inc/edit_product.php";
                              break;
                    
      			
      			default:
      				include 'inc/view_all_products.php';
      				break;
      		}

      ?>



     