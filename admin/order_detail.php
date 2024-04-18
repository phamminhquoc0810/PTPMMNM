<?php 
    session_start();
   
?>
<?php
    $page_title = "Order Detail";
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
 
    // Kiểm tra xem có tham số order_id được truyền qua không
    if(isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        
        // Lấy thông tin về đơn hàng từ cơ sở dữ liệu
        $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Kiểm tra xem đơn hàng có tồn tại không
        if($result->num_rows > 0) {
            $order = $result->fetch_assoc();
            
            // Lấy thông tin về các mặt hàng trong đơn hàng từ bảng order_items
            $stmt_items = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
            $stmt_items->bind_param("i", $order_id);
            $stmt_items->execute();
            $order_items = $stmt_items->get_result();
            // Khởi tạo biến tổng số tiền của đơn hàng
            $total_order_cost = 0;
            
            // Tính tổng số tiền của đơn hàng
            while($item = $order_items->fetch_assoc()) {
                $total_order_cost += $item['product_price'] * $item['product_quantity'];
            }
        } else {
            // Nếu không tìm thấy đơn hàng, hiển thị thông báo lỗi
            echo "Order not found.";
            exit();
        }
    } else {
        // Nếu không có tham số order_id được truyền qua, hiển thị thông báo lỗi
        echo "Order ID not provided.";
        exit();
    }
 
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Order Detail</h2>
                </div>
            </div>
        </div>

        <div class="row column1">
                    <div class="col-md-8">
                        <a href="order_dashboard.php" class="btn btn-primary">Back</a>
                    </div>
                </div>

        <div class="row column1" style="background-color: #fff;">
                    <div class="table-responsive">
                        <table class="table table-triped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Item Id</th>
                                    <th scope="col">Product Id</th>
                                    <th scope="col">Product Name </th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Product Quantity</th>
                                    <th scope="col">Total</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($order_items as $order_item){ ?>
                                <tr>
                                <td><?php echo $order_item['item_id']; ?></td>
                                <td><?php echo $order_item['product_id']; ?></td>
                                <td><?php echo $order_item['product_name']; ?></td>
                                <td><img src="<?php echo "../assets/imgs/".$order_item['product_image'];?>" style="width: 70px; height: 70px;"  /></td>
                                <td>$ <?php echo $order_item['product_price']; ?></td>
                                <td><?php echo $order_item['product_quantity']; ?></td>
                                <td>$ <?php echo $order_item['product_price'] * $order_item['product_quantity']; ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="5" align="right"><strong>Total Cost:</strong></td>
                                    <td>$ <?php echo $total_order_cost; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>  
    </div>
</div>
<!-- end dashboard inner -->
</div>
         </div>
      </div>
      
      <style>

        table.table thead th {
            font-weight: bold; 
            color: black;
            font-size: 20px;
        }

        table.table tbody td {
            font-size: 16px;
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



