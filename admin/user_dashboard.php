<?php 
    session_start();
   
?>
<?php
    $page_title = "User Dashboard";
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

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>User Dashboard</h2>
                </div>
            </div>
        </div>

        <div class="row column1" style="background-color: #fff;">
            <div class="table-responsive">
                <table class="table table-triped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">User ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">User Email</th>
                            <th scope="col">User Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Truy vấn cơ sở dữ liệu để lấy thông tin về tất cả người dùng
                            $stmt = $conn->prepare("SELECT * FROM users");
                            $stmt->execute();
                            $users = $stmt->get_result();
                            
                            // Hiển thị thông tin của từng người dùng trong bảng
                            foreach($users as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user['user_id']; ?></td>
                            <td><?php echo $user['user_name']; ?></td>
                            <td><?php echo $user['user_email']; ?></td>
                            <td><?php echo $user['user_password']; ?></td>
                        </tr>
                        <?php } ?>
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
