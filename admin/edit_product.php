<?php session_start(); ?>
<?php
            
            include('../server/config.php');
            if(isset($_GET['product_id'])){
                $product_id = $_GET['product_id'];
                $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
                $stmt->bind_param("i", $product_id);
                $stmt->execute();
                $products = $stmt->get_result();
                
            }else if(isset($_POST['edit_btn'])){

                $product_id = $_POST['product_id'];
                $name = $_POST['product_name'];
                $description = $_POST['product_description'];
                $price = $_POST['product_price'];
                $special_offer = $_POST['product_special_offer'];
                $category = $_POST['product_category'];
                $color = $_POST['product_color'];


                $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?,product_price=?,
                                         product_special_offer=?,product_category=?, product_color=? WHERE product_id=?");

                $stmt->bind_param('ssssssi',$name,$description,$price,$special_offer,$category,$color,$product_id);     

                if($stmt->execute()){
                    header('location: product_dashboard.php?edit_success_message=Product has been update successfully');
                }else{
                    header('location: product_dashboard.php?edit_failure_message=Error occured, try again');
                }

                
            }else{
                header('product_dashboard.php');
                exit;
            }
           
?>
<?php
    $page_title = "Edit Product";
    include('header.php'); 
?>
<div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title">
                            <h2>EDIT PRODUCTS</h2>
                        </div>
                    </div>
                </div>
                
                <div class="row column1">
                    <div class="col-md-8">
                        <a href="product_dashboard.php" class="btn btn-primary">Back</a>
                    </div>
                </div>

                <div class="row column2" style="background-color: #fff;">
                    <form  id="edit-form" method="POST" action="edit_product.php"> 
                        <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                        <?php foreach($products as $product) {?>
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>" />
                        <div class="form-group ">
                        
                            

                            <label>Product Name:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>">
                        </div>
                        <!-- <div class="form-group">
                            <label>Product Image:</label>
                            <input type="text" class="form-control" id="product_image" name="product_image" value="<?php echo $product['product_image']; ?>">
                        </div> -->
                        <div class="form-group ">
                            <label>Product Price:</label>
                            <input type="text"  min="0" class="form-control" id="product_price" name="product_price" value="<?php echo $product['product_price']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Product Special Offer:</label>
                            <input type="number" min="0" class="form-control" id="product_special_offer" name="product_special_offer" value="<?php echo $product['product_special_offer']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Product Category:</label>
                            <select class="form-select" require name="product_category">
                                <option value="athletic">Athletic shoes</option>
                                <option value="highheels"> High heels shoes</option>
                                <option value="sandals">Sandals</option>
                                <option value="socks">Socks</option>
                                <option value="slip_on">Slip-on</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product Color:</label>
                            <input type="text" class="form-control" id="product_color" name="product_color" value="<?php echo $product['product_color']; ?>">
                        </div>
            
                        <div class="form-group">
                            <label>Product Description:</label>
                            <textarea id="product_description" class="form-control" name="product_description"><?php echo $product['product_description']; ?></textarea>
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





