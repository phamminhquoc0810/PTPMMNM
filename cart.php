<?php
include('server/config.php');
session_start();

// if (!isset($_SESSION['cart'])) {
//   $_SESSION['cart'] = array();
// }

// if (!isset($_SESSION['total'])) {
//   $_SESSION['total'] = 0;
// }
if(isset($_POST['add_to_cart'])){
  
  if(isset($_SESSION['cart'])){

      $product_array_ids = array_column($_SESSION['cart'],"product_id");
      if(!in_array($_POST['product_id'], $product_array_ids)){
        $product_id = $_POST['product_id'];
        $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
        );
    
        $_SESSION['cart'][$product_id] = $product_array;
    
      }else{
            echo '<script>alert("Sản phẩm đã tồn tại trong giỏ hàng")</script>';
           
      }

  }else{

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
    );

    $_SESSION['cart'][$product_id] = $product_array;


  }

  //tính tổng tiền trong cart
  totalCart();


// xóa sản phẩm khỏi giỏ hàng
}else if(isset($_POST['remove_product'])){

  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

  //tính tổng tiền trong cart
  totalCart();


}else if(isset($_POST['edit_quantity']) ){
  
  //lấy id và số lượng từ form
  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];
  //lấy mảng product từ session
  $product_array = $_SESSION['cart'][$product_id];
  //update số lượng sản phẩm
   $product_array['product_quantity'] = $product_quantity;
  //Return Array trở lại vị trí của nó
  $_SESSION['cart'][$product_id] = $product_array;
  
  //tính tổng tiền trong cart
  totalCart();


}else{
  //header('location: index.php');
}


function totalCart(){
  $total_price = 0;
  $total_quantity = 0;

  foreach($_SESSION['cart'] as $key => $value){

    $product = $_SESSION['cart'][$key];

    $price = $product['product_price'];
    $quantity = $product['product_quantity'];

    $total_price = $total_price + ($price * $quantity);
    $total_quantity = $total_quantity + $quantity;
  }
  $_SESSION['total'] = $total_price;
  $_SESSION['quantity'] = $total_quantity;
}


?>


<?php 
    $page_title = "Cart";

include('layouts/header.php'); 
?>

    <!--Cart-->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Your Cart</h2>
            <hr>
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
<?php if(isset($_SESSION['cart'])) {?>

            <?php foreach($_SESSION['cart'] as $key => $value){ ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $value['product_image']; ?>"/>
                        <div> 
                            <p><?php echo $value['product_name']; ?></p>
                            <small><span>$</span><?php echo $value['product_price']; ?></small>
                            <br>
                            <form method="POST" action="cart.php">
                              <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                              <input type="submit" name="remove_product" class="remove_btn" value="Remove" />
                            </form>
                            
                        </div>
                    </div>
                </td>

                <td>
                  
                  <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                    <input min="0" type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
                    <input type="submit" class="edit-btn" value="Save" name="edit_quantity" />
                  </form>
                    
                </td>

                <td>
                <span>$</span>
                    <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                    
                  </td>
            </tr>

            <?php }?>
            <?php } ?>
            

           
        </table>


        <div class="cart-total">
            <table>
                <!-- <tr>
                    <td>Subtotal</td>
                    <td>$155</td>
                </tr> -->
                <tr>
                    <td>Total</td>
                    <?php if(isset($_SESSION['total'])){ ?>
                      <td>$<?php echo $_SESSION['total']; ?></td>
                    <?php } ?>
                </tr>
            </table>
        </div>
        

        <div class="checkout-container">
          <form method="POST" action="checkout.php">
          <input type="submit"  class="btn checkout-btn" value="Checkout" name="checkout" />
          </form>
          
        </div>

    </section>

                    



    <?php include('layouts/footer.php'); ?>