<?php
 require_once "./.dblogin.php";

 $success = false;
 $error = false;
 $err = array();
 if($_SERVER["REQUEST_METHOD"] == "POST") {

     $name = clean_input($_POST["name"]);
     if(empty($name)) {
       array_push($err, "nameempty");
     }

     $username = clean_input($_POST["username"]);
     if(empty($username)) {
        array_push($err, "usernameempty");

     }

     $email =clean_input($_POST["email"]);
     if(empty($email)) {
        array_push($err, "emailempty");
     }

     $bdate = clean_input($_POST["bdate"]);
     if(empty($bdate)) {
       array_push($err, "bdateempty");
     }

     if(empty(clean_input($_POST["pwrd"]))) {
       array_push($err, "pwrdempty");

     }
     $pwrd = password_hash(clean_input($_POST["pwrd"]), PASSWORD_DEFAULT);

     if(!(password_verify(clean_input($_POST["conf-pwrd"]), $pwrd))) {
       array_push($err, "nomatch");
     }

     if(!sizeof($err)) {
        $conn = dbconnect();

        $stmt = $conn->prepare("INSERT INTO Account (username, email, psswrd, b_date, name) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $pwrd, $bdate, $name);

        if($stmt->execute()) {
           $success = true;
        }


        $stmt->close();
        dbclose($conn);


     }


 }

 if($success) {
    header('location: login.php');
    exit;
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
   require './navbar.php';
   ?>
   <div class="content">
      <div class="create-account">
         <h1>Create an Account</h1>
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="create-account-input">
               <?php $error = in_array("nameempty", $err); ?>
               <label>Name:</label><br>
               <input type="text" name="name" <?php if($error) echo 'class="input-error"'; ?>>
            </div>
            <div class="create-account-input">
               <?php $error = in_array("usernameempty", $err); ?>
               <label>Username:</label><br>
               <input type="text" name="username" <?php if($error) echo 'class="input-error"'; ?>>
            </div>
            <div class="create-account-input" id="create-account-email">
               <?php $error = in_array("emailempty", $err); ?>
               <label>Email:</label><br>
               <input type="email" name="email" <?php if($error) echo 'class="input-error"'; ?>>
            </div>
            <div class="create-account-input" id="create-account-bday">
               <?php $error = in_array("bdateempty", $err); ?>
               <label>Birth Date:</label><br>
               <input type="date" name="bdate" <?php if($error) echo 'class="input-error"'; ?>>
            </div>
            <div class="create-account-input">
               <?php $error = in_array("pwrdempty", $err); ?>
               <label>Password:</label><br>
               <input type="password" name="pwrd" <?php if($error) echo 'class="input-error"'; ?>>
            </div>
            <div class="create-account-input">
              <?php $error = in_array("nomatch", $err); ?>
               <label>Confirm Password:</label><br>
               <input type="password" name="conf-pwrd" <?php if($error) echo 'class="input-error"'; ?>>
            </div>
            <input type="submit" value="Create Account" id="create-account-submit">
         </form>
      </div>
   </div>

</body>

</html>
