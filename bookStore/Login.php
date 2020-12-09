<?php
    session_start();
    if(array_key_exists('LoginMessage', $_SESSION)) {
      echo "<script>alert('".$_SESSION['LoginMessage']."')</script>";
    }
    unset($_SESSION['LoginMessage']);
    $servername = "localhost";
    $username = "ci.xristodoulou";
    $password = "Christos";
    $dbname = "ci_xristodoulou";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //declaring variable for error messages
    $error = "";

    if (array_key_exists('submit', $_POST)){

      if(!$_POST['email']) {
        $error .= "<p>An email address is Required</p>";
      }

      if(!$_POST['password']) {
        $error .= "<p>A password is Required</p>";
      }
      //check if the error variable is not empty and if its not empty display the error
      if($error != "") {
        $error = "<p>There are error(s) in your form</p>".$error;
      } else {
        // if its empty then check if the username and password are correct from the database and redirect them
        $query = "SELECT * FROM `Customers` WHERE `C_email` = '".mysqli_real_escape_string($conn, $_POST['email'])."'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        if (($row['password'] == $_POST['password']) && ($row['C_email'] == $_POST['email'])){
          $_SESSION['Customer'] = $row['Customer_id'];
          if($_POST['checkbox'] == 'checked') { //if they tick the checkbox then set the cookie to stay logged in
            setcookie("StayLoggedIn", 'userLogIn', time() + 60*60*1);
          }
          $_SESSION['StayLoggedIn'] = $_COOKIE['StayLoggedIn'];
          header("Location: loggedIn.php");
        }  else {
          $error = "<p>Please enter a correct username and password!!</p>";
        }
      }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="assets/css/main.css"> -->
    <link rel="stylesheet" href="css/index.css">

    <title>Log in</title>
  </head>
  <body>
    <div class="container">
      <div class="jumbotron jumbotron-fluid jumbotron_me">
        <div class="container">
          <h1 class="display-4">WELCOME TO e-BookStore</h1>
          <!-- <p class="lead">Please log in to explore our Book Store.</p> -->
        </div>
      </div>
    </div>
		<div class="container container2">
				<div class="jumbotron">
					<form method="post">
						  <div class="form-group row">
						    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
						    <div class="col-sm-10">
						      <input type="email" class="form-control" name="email" id="email" placeholder="Email">
						    </div>
						  </div>
						  <div class="form-group row">
						    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
						    <div class="col-sm-10">
						      <input type="password" class="form-control" name ="password" id="email" placeholder="Password">
						    </div>
						  </div>

              <div class="form-group row">
						    <div class="col-sm-12">
						      <input type="checkbox" class="btn btn-primary" name="checkbox" value="checked"></input>
                  <label for="ckeckbox">Stay Logged In!</label>
						    </div>
						  </div>

              <div class="form-group row">
						    <div class="col-sm-10">
						      <input type="submit" class="btn btn-primary btnsubmit" name="submit" value="submit"></input>
						    </div>
						  </div>
              <div class="form-group-row">
                <div class="class-sm-10">
                  <div class="errorMessage" style="color: red;">
                    <?php echo $error; ?>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <p>Don't have an accound?</p>
                </div>
                <div class="col-sm-12">
                <a href="signUp.php">SIGN UP NOW!</a>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <p>Are you an employee?</p>
                </div>
                <div class="col-sm-12">
                <a href="login_employee.php">SIGN IN FROM HERE</a>
                </div>
              </div>
						</form>
						</form>

				</div>
		</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
