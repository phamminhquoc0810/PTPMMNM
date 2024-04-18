<?php 
    session_start();
   
 ?>
 
 <?php
     $page_title = "Orders Dashboard";
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

  $stmt1= $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
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


  $smtm2 = $conn->prepare("SELECT * FROM orders LIMIT $offset, $total_records_per_page");
  $smtm2->execute();
  $orders = $smtm2->get_result();

    
  
?>


 <!-- dashboard inner -->
 <div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title">
                            <h2>ORDERS</h2>
                        </div>
                    </div>
                </div>

                <?php if(isset($_GET['order_updated'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['order_updated'] ?></p>
                <?php }?>
                <?php if(isset($_GET['order_failed'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['order_failed'] ?></p>
                <?php }?>

                <div class="row column1" style="background-color: #fff;">
                    <div class="table-responsive">
                        <table class="table table-triped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">User Id </th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">User Phone</th>
                                    <th scope="col">User Address</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($orders as $order){ ?>
                                <tr>
                                    <td><?php echo $order['order_id'];?></td>
                                    <td><?php echo $order['order_status'];?></td>
                                    <td><?php echo $order['user_id'];?></td>
                                    <td><?php echo $order['order_date'];?></td>
                                    <td><?php echo $order['user_phone'];?></td>
                                    <td><?php echo $order['user_address'];?></td>

                                    <td><a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $order['order_id']; ?>">Edit</a></td>
                                    <td><a class="btn btn-danger" href="order_detail.php?order_id=<?php echo $order['order_id']; ?>" >Details</a></td>
                                    
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


