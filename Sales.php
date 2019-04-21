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
      			case 'add_sale':
      				include"inc/add_sale.php";
      				break;
                        case 'edit_product':
                              include"inc/edit_sale.php";
                              break;
                    
      			
      			default:
      				include 'inc/view_all_sales.php';
      				break;
      		}

      ?>



     