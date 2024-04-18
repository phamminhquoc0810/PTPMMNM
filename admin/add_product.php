<?php session_start(); ?>
<?php
    include('../server/config.php');
?>
<?php
    $page_title = "Create Product";
    include('header.php'); 
?>
<div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title">
                            <h2>CREATE PRODUCTS</h2>
                        </div>
                    </div>
                </div>
                
                <div class="row column1">
                    <div class="col-md-8">
                        <a href="product_dashboard.php" class="btn btn-primary">Back</a>
                    </div>
                </div>

                <div class="container" style="background-color: #fff;">
                    <form  id="create-form" enctype="multipart/form-data" method="POST" action="create_products.php"> 
                        <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                        
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>" />
                        <div class="form-group">
                            <label>Product Name:</label>
                            <input type="text" class="form-control" id="product_name" name="name" placeholder="Name" required />
                        </div>

                        <div class="form-group">
                            <label>Product Description:</label>
                            <input type="text" id="product_des" class="form-control" name="description" placeholder="Description" required />
                        </div>
                       
                        <div class="form-group">
                            <label>Product Price:</label>
                            <input type="text"  min="0" class="form-control" id="product_price" name="price" placeholder="Price" required />
                        </div>
                        <div class="form-group">
                            <label>Product Special Offer:</label>
                            <input type="number" min="0" class="form-control" id="product_offer" name="offer" placeholder="Offer" required />
                        </div>
                        <div class="form-group">
                            <label>Category:</label>
                            <select class="form-select" require name="category">
                                <option value="athletic">Athletic shoes</option>
                                <option value="highheels"> High heels shoes</option>
                                <option value="sandals">Sandals</option>
                                <option value="socks">Socks</option>
                                <option value="slip_on">Slip-on</option>
                            </select>
                        </div>
                         
                        <div class="form-group">
                            <label>Product Color:</label>
                            <input type="text" class="form-control" id="product_color" name="color" placeholder="Color" required />
                        </div>
                        <div class="form-group">
                            <label>Product Image 1:</label>
                            <input type="file" class="form-control" id="image1" name="image1"  placeholder="Image1" required/>
                        </div>
                        <div class="form-group">
                            <label>Product Image 2:</label>
                            <input type="file" class="form-control" id="image2" name="image2"  placeholder="Image2" required/>
                        </div>
                        <div class="form-group">
                            <label>Product Image 3:</label>
                            <input type="file" class="form-control" id="image3" name="image3"  placeholder="Image3" required/>
                        </div>
                        <div class="form-group">
                            <label>Product Image 4:</label>
                            <input type="file" class="form-control" id="image4" name="image4"  placeholder="Image4" required/>
                        </div>
            
                       
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="create_product" value="Create" />
                        </div>
                        
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
