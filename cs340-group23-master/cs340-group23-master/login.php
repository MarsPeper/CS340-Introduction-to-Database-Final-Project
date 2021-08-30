<?php
session_start();



if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
   require_once "./.dblogin.php";

   $con = dbconnect();

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "PLease enter your username";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["pwrd"]))){
        $password_err = "Please enter your password";
    } else{
        $password = trim($_POST["pwrd"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, psswrd FROM Account WHERE username=?";

        if($stmt = mysqli_prepare($con, $sql)) {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session


                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user"] = $username;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Your password is invalid";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "Your username is invalid";
                }
            } else{
                echo "Please try again.";
            }


        // Close statement
        mysqli_stmt_close($stmt);
      }

    }
    dbclose($con);
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php
   require './head.php';
   ?>

</head>
<body>
   <?php
   require './navbar.php'
   ?>

   <div class="content">
      <div class="login">
         <h1>Log In</h1>

         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="login-input">
               <input type="text" name="username" placeholder="Username" class="<?php
                  if(!empty($username_err)) echo "input-error";
               ?>" value="<?php echo $username; ?>">
               <?php
                if(!empty($username_err)) {
                  echo "<p><span class='input-error'>" . $username_err . "</span></p>";
                }
               ?>

            </div>

            <div class="login-input">
                <input type="password" name="pwrd" placeholder="Password" class="<?php
                   if(!empty($password_err)) echo "input-error";

                ?>">
                <?php
                 if(!empty($password_err)) {
                   echo "<p><span class='input-error'>". $password_err . "</span></p>";
                 }
                 ?>

            </div>
            <input type="submit" id="login-submit" value="Log In">

         </form>

      </div>

   </div>

</body>

</html>
