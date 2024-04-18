<?php  session_start(); ?>
<?php
            
            include('../server/config.php');
            if(isset($_GET['order_id'])){
                $order_id = $_GET['order_id'];
                $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
                $stmt->bind_param("i", $order_id);
                $stmt->execute();
                $order = $stmt->get_result();
            }else if(isset($_POST['edit_btn'])){

                $order_status = $_POST['order_status'];
                $order_id = $_POST['order_id'];

                $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");

                $stmt->bind_param('si',$order_status,$order_id);     

                if($stmt->execute()){
                    header('location: order_dashboard.php?order_updated=Product has been update successfully');
                }else{
                    header('location: order_dashboard.php?order_failed=Error occured, try again');
                }
            }else{
                header('order_dashboard.php');
                exit;
            }
            

       
?>
<?php
    $page_title = "Edit Order";
    include('header.php'); 
?>
<div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title">
                            <h2>UPDATE ORDERS</h2>
                        </div>
                    </div>
                </div>
                
                <div class="row column1">
                    <div class="col-md-8">
                        <a href="product_dashboard.php" class="btn btn-primary">Back</a>
                    </div>
                </div>

                <div class="container" style="background-color: #fff;">
                    <form  id="edit-form" method="POST" action="edit_order.php"> 
                        <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                        <?php foreach($order as $r) {?>
                            
                        <div class="form-group">
                            <label>Order ID</label>
                            <p class="my-4"><?php echo $r['order_id'];?></p>
                        </div>
                       
                        <div class="form-group">
                            <label>Order Price</label>
                            <p class="my-4"><?php echo $r['order_cost'];?></p>
                        </div>

                        <input type="hidden" name="order_id" value="<?php echo $r['order_id'];?>" />
                        <div class="form-group">
                            <label>Order Status:</label>
                            <select class="form-select" require name="order_status">
                               
                                <option value="not paid"  <?php if($r['order_status']=='not paid'){echo "selected";} ?> >Not paid</option>
                                <option value="paid" <?php if($r['order_status']=='paid'){echo "selected";} ?> >Paid</option>
                                <option value="shipped" <?php if($r['order_status']=='shipped'){echo "selected";} ?> >Shipped</option>
                                <option value="delivered" <?php if($r['order_status']=='delivered'){echo "selected";} ?> >Delivered</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Order Date</label>
                            <p class="my-4"><?php echo $r['order_date'];?></p>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="edit_btn">Save Changes</button>
                        </div>
                        <?php }?>
                    </form>
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





