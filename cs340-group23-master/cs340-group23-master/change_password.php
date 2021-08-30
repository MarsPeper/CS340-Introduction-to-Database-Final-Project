<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
   $_SESSION["err"] = "";
   require_once "./.dblogin.php";
   $con = dbconnect();

   if(clean_input($_POST["pwrd"]) == clean_input($_POST["conf-pwrd"])) {
      $new_password = password_hash(clean_input($_POST["pwrd"]), PASSWORD_DEFAULT);

      $username = $_SESSION["user"];
      $password = clean_input($_POST["old-pwrd"]);

      $sql = "SELECT username, psswrd FROM Account WHERE username=?";

      if($stmt = mysqli_prepare($con, $sql)) {
          mysqli_stmt_bind_param($stmt, "s", $param_username);
          $param_username = $username;

          if(mysqli_stmt_execute($stmt)){
              mysqli_stmt_store_result($stmt);

              if(mysqli_stmt_num_rows($stmt) == 1){
                  mysqli_stmt_bind_result($stmt, $username, $hashed_password);

                  if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                      $stmt2 = $con->prepare("UPDATE Account SET psswrd=? WHERE username=?");
                      $stmt2->bind_param("ss", $new_password, $username);

                      $stmt2->execute();

                      $stmt2->close();

                    }
                    else {
                      $_SESSION["err"] = "Invalid Password";
                    }
                  }
              }


          }
          mysqli_stmt_close($stmt);

       }
     }
     else {
       $_SESSION["err"] = "Passwords do not match";
     }

   dbclose($con);

   if(empty($_SESSION["err"])) {
      header('location: logout.php');
      exit;
   }
   else {
      header('location: profile.php?tab=changepwrd');
      exit;
   }

}

?>

<h2>Change Your Password</h2>

<?php
 if(isset($_SESSION["err"]) && !empty($_SESSION["err"])) {
    echo "<p><span class='input-error'>" . $_SESSION['err'] . "</span></p>";

 }
 ?>

<form method="POST" action="change_password.php">
   <div class="profile-page-pwrd">
     <input type="password" name="pwrd" placeholder="New Password">
   </div>
   <div class="profile-page-pwrd">
      <input type="password" name="conf-pwrd" placeholder="Confirm New Password">
   </div>
   <div class="profile-page-pwrd">
      <input type="password" name="old-pwrd" placeholder="Confirm Old Password">
   </div>
   <input type="submit" name="submit" value="Change Password" id="new-pwrd-submit">

</form>
