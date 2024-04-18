<?php 
    session_start();
    
 ?>
 <?php
    $page_title = "Prouducts Dashboard";
    include('header.php');
?>
<?php
    include('../server/config.php');
?>
 <?php
    
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: ../login.php');
        exit();
    }
 
 
 ?>


<?php

if(isset($_GET['page_no']) && $_GET['page_no'] !=""){
    $page_no = $_GET['page_no'];
  }else{
    $page_no = 1;
  }

  $stmt1= $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();


  $total_records_per_page = 5;

  $offset = ($page_no-1) * $total_records_per_page;

  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;

  $adjacents = "2";

  $total_no_of_pages = ceil($total_records/$total_records_per_page);


  $smtm2 = $conn->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
  $smtm2->execute();
  $products = $smtm2->get_result();

    
  
?>


 <!-- dashboard inner -->
 <div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title">
                            <h2>PRODUCTS</h2>
                        </div>
                    </div>
                </div>

                <?php if(isset($_GET['edit_success_message'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message'] ?></p>
                <?php }?>
                <?php if(isset($_GET['edit_failure_message'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message'] ?></p>
                <?php }?>


                <?php if(isset($_GET['deleted_successfully'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully'] ?></p>
                <?php }?>
                <?php if(isset($_GET['deleted_failure'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure'] ?></p>
                <?php }?>


                <?php if(isset($_GET['product_created'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['product_created'] ?></p>
                <?php }?>
                <?php if(isset($_GET['product_failed'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['product_failed'] ?></p>
                <?php }?>

                <?php if(isset($_GET['images_updated'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['images_updated'] ?></p>
                <?php }?>
                <?php if(isset($_GET['images_failed'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['images_failed'] ?></p>
                <?php }?>



                <div class="row column1">
                    <div class="col-md-8">
                        <a href="add_product.php" class="btn btn-primary">Add product</a>
                    </div>
                </div>
                <div>
                <div class="row column2 " style="background-color: #fff;">
                    <div class="table-responsive">
                        <table class="table table-triped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Product Id</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Product Offer</th>
                                    <th scope="col">Product Category</th>
                                    <th scope="col">Product Color</th>
                                    <th scope="col">Edit Images</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($products as $product){ ?>
                                <tr>
                                    <td><?php echo $product['product_id'];?></td>
                                    <td><img src="<?php echo "../assets/imgs/".$product['product_image'];?>" style="width: 70px; height: 70px;"  /></td>
                                    <td><?php echo $product['product_name'];?></td>
                                    <td><?php echo "$".$product['product_price'];?></td>
                                    <td><?php echo $product['product_special_offer']. "%";?></td>
                                    <td><?php echo $product['product_category'];?></td>
                                    <td><?php echo $product['product_color'];?></td>
                                    <td><a class="btn btn-warning" href="<?php echo "edit_images.php?product_id=".$product['product_id']."&product_name=".$product['product_name'];?>">Edit Images</a></td>
                                    <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product['product_id'];?>">Edit</a></td>
                                    <td><a class="btn btn-danger" href="delete_product.php?product_id=<?php echo $product['product_id'];?>">Delete</a></td>
                                    
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>    
                     
                        
                    
            </div>
                     


                  </div>
                  <!-- footer -->
                  <!-- <div class="container-fluid">
                     <div class="footer">
                        <p>Copyright © 2018 Designed by html.design. All rights reserved.<br><br>
                           Distributed By: <a href="https://themewagon.com/">ThemeWagon</a>
                        </p>
                     </div>
                  </div> -->
                    <nav aria-label="Page navigation example" class="mx-auto">
                        <ul class="pagination mt-5 mx-auto">
                             <li class="page-item <?php if($page_no<=1){ echo 'disabled';} ?>">
                                <a class="page-link" href="<?php if($page_no <= 1){ echo '#';}else{ echo "?page_no=".($page_no-1);} ?>">Previous</a>
                             </li>
                            <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                            <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>
                            <?php if($page_no >=3) {?>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no;?>"><?php echo $page_no; ?></a></li>
                            <?php } ?>

                            <li class="page-item <?php if($page_no >= $total_no_of_pages){ echo 'disabled';} ?>">
                                <a class="page-link" href="<?php if($page_no > $total_no_of_pages){ echo '#';}else{ echo "?page_no=".($page_no+1);} ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
      
      <style>

        table.table thead th {
            font-weight: bold; 
            color: black;
        }

        table.table tbody td {
            
            color: black; 
        }
    </style>
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script> 
      <!-- chart js -->
      <script src="js/Chart.min.js"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="js/utils.js"></script>
      <script src="js/analyser.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <script src="js/chart_custom_style1.js"></script>
   </body>
</html>


