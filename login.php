<?php
session_start();
include('server/config.php');

if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}
if(isset($_SESSION['admin_logged_in'])){
  header('location: admin/dashboard.php');
  exit;
}

if(isset($_POST['login_btn'])){
  
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  // Check if the credentials match with a user account
  $stmt =  $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");
  $stmt->bind_param('ss', $email, $password);

  if($stmt->execute()){
    $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
    $stmt->store_result();

    if($stmt->num_rows() == 1){
      $row = $stmt->fetch();
        
      $_SESSION['user_id'] = $user_id;
      $_SESSION['user_name'] = $user_name;
      $_SESSION['user_email'] = $user_email;
      $_SESSION['logged_in'] = true;

      header('location: account.php?login_success=Logged in successfully');

    } else {
      // Check if the credentials match with an admin account
      $stmt_admin = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");
      $stmt_admin->bind_param('ss', $email, $password);

      if($stmt_admin->execute()){
        $stmt_admin->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $stmt_admin->store_result();

        if($stmt_admin->num_rows() == 1){
          $row_admin = $stmt_admin->fetch();
            
          $_SESSION['admin_id'] = $admin_id;
          $_SESSION['admin_name'] = $admin_name;
          $_SESSION['admin_email'] = $admin_email;
          $_SESSION['admin_logged_in'] = true;

          header('location: admin/dashboard.php?login_success=Logged in successfully');

        } else {
          header('location: login.php?error=Could not verify your account');
        }
      } else {
        header('location: login.php?error=Something went wrong');
      }
    }
      
  } else {
    header('location: login.php?error=Something went wrong');
  }
}
?>









<?php 
    $page_title = "Login";

include('layouts/header.php'); 
?>



      <!--Login-->
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Login</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="login-form" method="POST" action="login.php">
              <p style="color: red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-pass" name="password" placeholder="Password" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
                </div>

                <div class="form-group">
                    <a id="register-url" href="register.php" class="btn">Don't have account? Register</a>
                </div>
            </form>
        </div>
      </section>



      <?php include('layouts/footer.php'); ?>