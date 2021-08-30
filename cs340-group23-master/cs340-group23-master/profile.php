<?php
session_start();
require_once "./.dblogin.php";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
   $con = dbconnect();
   $username = $_SESSION["user"];
   $email = $phone_numb = $b_date = $name = "";

   $sql = "SELECT email, phone_numb, b_date, name FROM Account WHERE username=?";

   if($stmt = mysqli_prepare($con, $sql)) {

      mysqli_stmt_bind_param($stmt, "s", $param_username);

      $param_username = $username;

      if(mysqli_stmt_execute($stmt)) {
         mysqli_stmt_store_result($stmt);

         if(mysqli_stmt_num_rows($stmt) == 1 ) {
            mysqli_stmt_bind_result($stmt, $email, $phone_numb, $b_date, $name);
            mysqli_stmt_fetch($stmt);
         }

      }

      mysqli_stmt_close($stmt);


   }




   dbclose($con);


}
else {
   header("location: login.php");
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
   $tab = "";
   if($_SERVER["REQUEST_METHOD"] == "GET") {
      if(isset($_GET["tab"])) {
         $tab = $_GET["tab"];
      }
      else if(isset($_GET["search"])) {
        $tab = "employment";
      }
   }

   ?>
   <div class="content">
     <div class="profile-page-container">
        <div class="profile-page-sidebar">
           <h2><a href="index.php">Braden's List</a></h2>
           <ul>
             <li class="<?php if(empty($tab)) echo "selected"; ?>"><a href="./profile.php">Your Profile</a></li>
             <li class="<?php if($tab == "editprofile") echo "selected"; ?>"><a href="./profile.php?tab=editprofile">Edit Profile</a></li>
             <li class="<?php if($tab == "changepwrd") echo "selected"; ?>"><a href="./profile.php?tab=changepwrd">Change Password</a></li>
             <li class="<?php if($tab == "employment") echo "selected"; ?>"><a href="./profile.php?tab=employment">Employment</a></li>
           </ul>
        </div>
        <div class="profile-page-view">
           <?php

           if(empty($tab)) {
              echo '<h2>' . $name . '</h2>';
              echo '<p><span>Username:</span> ' . $username . '</p>';
              echo '<p><span>Email:</span> ' . $email . '</p>';
              if(!empty($phone_numb)) {
                echo '<p><span>Phone Number:</span> ' . $phone_numb . '</p>';

              }
              echo '<p><span>Birth Date:</span> ' . date("F j, Y", strtotime($b_date)) . '</p>';


            }
            else if ($tab == "editprofile") require "edit_profile.php";
            else if ($tab == "changepwrd") require "change_password.php";
            else if ($tab == "employment") require "employment.php";

            ?>


        </div>
     </div>

   </div>
</body>

</html>
