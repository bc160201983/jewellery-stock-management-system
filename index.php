<?php include'inc/header.php'; ?>
<?php

session_start();

if (isset($_SESSION['user_id'])) {
	header("Location: dashboard.php");
}


$errors = array();

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) || empty($password)) {
		if ($username == "") {
			$errors[] = "Username is required";
		}

		if ($password == "") {
			$errors[] = "Password is required";
		}
	}else{

		$query = "SELECT * FROM `users` WHERE username = '$username'";
		$result = mysqli_query($connection, $query);
		if(mysqli_num_rows($result) == 1){
			$password = md5($password);
			$maimQuery = "SELECT * FROM `users` WHERE username = '$username' AND password = '$password'";
			$mainResult = mysqli_query($connection, $maimQuery);
			if(mysqli_num_rows($mainResult) == 1){
				$row = mysqli_fetch_assoc($mainResult);
				$user_id = $row['user_id'];

				//set session
				$_SESSION['user_id'] = $user_id;
				header("Location: dashboard.php");
			}else{
				$errors[] = "Incorrect username/password combination";
			}
		}else{

			$errors[] = "Username dosenot exists";
		}
	}
}



?>
<div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="./assets/brand/tabler.svg" class="h-6" alt="">
              </div>
              <?php

              	if ($errors) {
              		foreach ($errors as $key => $value) {
              			echo '<div class="alert alert-danger"><strong>' . $value .'</strong></div>';
              		}
              	}

              ?>
              
              <form class="card" action="" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Login to your account</div>
                  <div class="form-group">
                    <label class="form-label">User Name</label>
                    <input name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password
                      <a href="./forgot-password.html" class="float-right small">I forgot password</a>
                    </label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <span class="custom-control-label">Remember me</span>
                    </label>
                  </div>
                  <div class="form-footer">
                    <button name="submit" type="submit" class="btn btn-primary btn-block">Sign in</button>
                  </div>
                </div>
              </form>
              <div class="text-center text-muted">
                Don't have account yet? <a href="./register.html">Sign up</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
