<?php

  session_start();
  include('server/config.php');

  if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
  }

  if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if($password !== $confirmPassword){
      header('location: register.php?error=Password dont match');
    
    
    }else if(strlen($password) < 6){
      header('location: register.php?error=Password must be at least 6 characters');
    
    //nếu không có lỗi
    }else{
          //kiểm tra xem có người dùng có email này hay không
          $stmt = $conn->prepare("SELECT count(*) FROM users where user_email=?");
          $stmt->bind_param('s',$email);
          $stmt->execute();
          $stmt->bind_result($num_rows);
          $stmt->store_result();
          $stmt->fetch();


          //nếu có user đã đăng ký với email này
          if($num_rows != 0){
            header('location: register.php?error=user with this email already exists');
          }else{

                  $stmt1 = $conn->prepare("INSERT INTO users (user_name,user_email,user_password)
                                          VALUES (?,?,?)");

                  $stmt1->bind_param('sss',$name,$email,md5($password));


                  if($stmt1->execute()){

                      $user_id = $stmt->insert_id;
                      $_SESSION['user_id'] = $user_id;
                      $_SESSION['user_email'] = $email;
                      $_SESSION['user_name'] = $name;
                      $_SESSION['logged_in'] = true;
                      header('location: account.php?register_seccess=You registerd successfully');
                  }else{
                        header('location: register.php?register_error=could not create an account at the moment');
                  }
          }
        }
  }


?>



<?php 
    $page_title = "Register";

include('layouts/header.php'); 
?>



    <!--Register-->
    <section class="my-5 py-5">
      <div class="container text-center mt-3 pt-5">
          <h2 class="form-weight-bold">Register</h2>
          <hr class="mx-auto">
      </div>
      <div class="mx-auto container">
          <form id="register-form" method="POST" action="register.php">
            <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
              <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required/>
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required/>
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required/>
              </div>
              <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="confirmPassword" required/>
              </div>
              <div class="form-group">
                  <input type="submit" class="btn" id="register-btn" name="register" value="Register"/>
              </div>

              <div class="form-group">
                  <a id="Login-url" href="login.php" class="btn">Do you have an account? Login</a>
              </div>
          </form>
      </div>
    </section>



    <?php include('layouts/footer.php'); ?>