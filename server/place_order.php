<?php
    session_start();
    include('config.php');

    if(!isset($_SESSION['logged_in'])){
        header('location: ../checkout.php?message=Please login/register to place an order');
        exit;
        
    }else{


            if(isset($_POST['place_order'])){
                //1. lấy thông tin user và lưu trữ trong database
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $city = $_POST['city'];
                $address = $_POST['address'];
                $order_cost = $_SESSION['total'];
                $order_status = "not paid";
                $user_id = $_SESSION['user_id'];
                $order_date = date('Y-m-d H:i:s');

                $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                                    VALUES (?,?,?,?,?,?,?); ");

                $stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);

                $stmt_status = $stmt->execute();


                if(!$stmt_status){
                    header('location: index.php');
                    exit;
                }


                //2.tạo đơn hàng mới và lưu trữ thông tin đơn hàng vào database.

                $order_id = $stmt->insert_id;

                

                //3. lấy product từ giỏ hàng(từ session)
                foreach($_SESSION['cart'] as $key => $value){
                    $product = $_SESSION['cart'][$key];
                    $product_id = $product['product_id'];
                    $product_name = $product['product_name'];
                    $product_image = $product['product_image'];
                    $product_price= $product['product_price'];
                    $product_quantity = $product['product_quantity'];

                    //4.lưu trữ từng mục vào database order_items
                    $stmt1 = $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
                                    VALUES (?,?,?,?,?,?,?,?)");

                    $stmt1->bind_param('iissiiis',$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);
                    $stmt1->execute();

                }


                //5.xóa tất cả trong cart
                //unset($_SESSION['cart']);
                $_SESSION['order_id'] = $order_id;

                header('location: ../payment.php?order_status=order placed successfully');

                
            }
    }
?>