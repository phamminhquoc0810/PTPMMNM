<?php 
    session_start();
    
 ?>
 <?php
    $page_title = "Account Dashboard";
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


  $total_records_per_page = 6;

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
                            <h2>ACCOUNT</h2>
                        </div>
                    </div>
                </div>

                <div class="container" style="background-color: #fff;">
                    <p>Id: <?php echo $_SESSION['admin_id']; ?></p>
                    <p>Name: <?php echo $_SESSION['admin_name']; ?></p>
                    <p>Email: <?php echo $_SESSION['admin_email']; ?></p>

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


