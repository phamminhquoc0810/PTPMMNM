
<?php
   session_start();
  

   if(!isset($_SESSION['admin_logged_in'])){
      header('location: ../login.php');
      exit();
   }
   include('../server/config.php');



   $sql_users = "SELECT COUNT(user_id) AS total_users FROM users";
   $result_users = mysqli_query($conn, $sql_users);
   $row_users = mysqli_fetch_assoc($result_users);
   $total_users = $row_users['total_users'];


   // Truy vấn để đếm số lượng products
   $sql_products = "SELECT COUNT(product_id) AS total_products FROM products";
   $result_products = mysqli_query($conn, $sql_products);
   $row_products = mysqli_fetch_assoc($result_products);
   $total_products = $row_products['total_products'];

   // Truy vấn để đếm số lượng orders
   $sql_orders = "SELECT COUNT(order_id) AS total_orders FROM orders";
   $result_orders = mysqli_query($conn, $sql_orders);
   $row_orders = mysqli_fetch_assoc($result_orders);
   $total_orders = $row_orders['total_orders'];

   mysqli_close($conn);
 ?>

<?php 
 $page_title = "DashBoard";
 include('header.php'); 
?>


               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Dashboard</h2>
                           </div>
                        </div>
                     </div>
                     <div class="row column1">
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-user yellow_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div class="text-center">
                                    <p class="total_no"><?php echo $total_users; ?></p>
                                    <p class="head_couter">User</p>
                                    <!-- <a class="btn btn-primary" href="ql_user.php">
                                       Xem chi tiết <i class="fa fa-arrow-right"></i> 
                                    </a> -->
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                 <i class="fa fa-cart-shopping red_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div class="text-center">
                                    <p class="total_no"><?php echo $total_orders; ?></p>
                                    <p class="head_couter">Order</p>
                                    <a class="btn btn-primary" href="order_dashboard.php">
                                       Xem chi tiết <i class="fa fa-arrow-right"></i> 
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                 <i class="fa fa-layer-group green_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div class="text-center">
                                    <p class="total_no"><?php echo $total_products; ?></p>
                                    <p class="head_couter">Product</p>
                                    <a class="btn btn-primary" href="product_dashboard.php">
                                       Xem chi tiết <i class="fa fa-arrow-right"></i> 
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-comments-o red_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no">54</p>
                                    <p class="head_couter">Comments</p>
                                 </div>
                              </div>
                           </div>
                        </div> -->
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
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
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