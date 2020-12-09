<?php
    session_start();
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

    $error = "";

  //  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      if(array_key_exists('submit', $_POST)) {
      //check whether a email is not included and append the error message
      if(!$_POST['email']) {
        $error .= "<p>An email address is Required</p>";
      }
      //check whether the password is not included and append the error message
      if(!$_POST['password']) {
        $error .= "<p>A password is Required</p>";
      }
      //check whether the password is not included and append the error message
      if(!$_POST['phone']) {
        $error .= "<p>A phone is Required</p>";
      }
      //check whether the password is not included and append the error message
      if(!$_POST['name']) {
        $error .= "<p>A name name is Required</p>";
      }
      //check whether the password is not included and append the error message
      if(!$_POST['surname']) {
        $error .= "<p>A surname is Required</p>";
      }
      //checking if there is not empty the $error variable, then we display them the error message
      if($error != "") {
        $error = "<p>There are error(s) in your form: </p>".$error;
        } else {

        $query = "SELECT * FROM customers WHERE C_email = '".mysqli_real_escape_string($conn, $_POST['email'])."'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0){
          $error = "<p>This Email Address is already taken</p>";
        } else {
          $query6 = "INSERT INTO `Customers` VALUES (NULL,'".mysqli_real_escape_string($conn, $_POST['email'])."','".mysqli_real_escape_string($conn, $_POST['password'])."','".mysqli_real_escape_string($conn, $_POST['name'])."','".mysqli_real_escape_string($conn, $_POST['surname'])."','".mysqli_real_escape_string($conn, $_POST['phone'])."')";
          $result = mysqli_query($conn, $query6);
          //excecuting the query. And if its not excecuted for any reason we remind the user to know to try later. If it is excecuted continue to the main page
          if(!$result) {
            $error ="<p> Please Try again Later. Something went wrong</p>";
          } else {
            //setting the cookie if the checkbox is checked
            if($_POST['checkbox'] == 'checked') {
              setcookie("StayLoggedIn", 'userLogIn', time() + 60*60*1);
            }
            //we set the session to be equal to the cookie so we can refer to the logged in page to redirect back to the sign up page if its not set.
            $_SESSION['StayLoggedIn'] = $_COOKIE['StayLoggedIn'];
            $_SESSION['LoginMessage'] = "Your Account was created. Please login";
            header("Location: Login.php");
            // or i can redirect him direct with header("Location: loggedIn.php")
            // but i will not have his custoer id number so he cannot order books, unless he resign in.
          }
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
    <!-- heading -->
    <div class="container">
      <div class="jumbotron jumbotron-fluid jumbotron_me">
        <div class="container">
          <h1 class="display-4">WELCOME TO e-BookStore</h1>
        </div>
      </div>
    </div>
    <!--  Sign up form  -->
    <div class="container container2">
        <div class="jumbotron">
          <form method="post">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="email" id="emaill" placeholder="Email">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name ="password" id="password" placeholder="Password">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name ="name" id="name" placeholder="Password">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name ="surname" id="surname" placeholder="Surname">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Phone Number</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name ="phone" id="phone" placeholder="Phone Number">
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
                  <input type="submit" name="submit" value="submit"class="btn btn-primary btnsubmit"></input>
                </div>
              </div>
              <div class="form-group-row">
                <div class="class-sm-10">
                  <div class="errorMessage">
                    <p><?php echo $error; ?></p>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <p>Already have an accound?</p>
                </div>
                <div class="col-sm-12">
                <a href="Login.php">SIGN IN</a>
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
				</div>
		</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
