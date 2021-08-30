<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
   require_once "./.dblogin.php";
   $con = dbconnect();

   $username = $_SESSION["user"];

   $name = clean_input($_POST["name"]);
   if(empty($name) == false) {
     $stmt = $con->prepare("UPDATE Account SET name=? WHERE username=?");
     $stmt->bind_param("ss", $name, $username);

     $stmt->execute();

     $stmt->close();

   }

   $email = clean_input($_POST["email"]);
   if(empty($email) == false) {
     $stmt = $con->prepare("UPDATE Account SET email=? WHERE username=?");
     $stmt->bind_param("ss", $email, $username);

     $stmt->execute();

     $stmt->close();

   }

   $phone_numb = clean_input($_POST["phone_numb"]);
   if(empty($phone_numb) == false) {
     $stmt = $con->prepare("UPDATE Account SET phone_numb=? WHERE username=?");
     $stmt->bind_param("ss", $phone_numb, $username);

     $stmt->execute();

     $stmt->close();

   }

   $b_date = clean_input($_POST["b_date"]);
   if(empty($b_date) == false) {
     $stmt = $con->prepare("UPDATE Account SET b_date=? WHERE username=?");
     $stmt->bind_param("ss", $b_date, $username);

     $stmt->execute();

     $stmt->close();

   }



   dbclose($con);


   header('location: profile.php');
   exit;

}


 ?>


<h2> Edit your Profile</h2>
<form method="POST" action="edit_profile.php">
   <div class="profile-page-update-input">
      <label>Change Name: </label>
      <input type="text" name="name" value="<?php echo $name; ?>">
   </div>
   <div class="profile-page-update-input">
      <label> Change Email: </label>
      <input type="email" name="email" value="<?php echo $email; ?>">
   </div>
   <div class="profile-page-update-input">
     <label><?php
      if(!empty($phone_numb)) {
         echo "Change Phone Number: ";
      }
      else {
        echo "Add Phone Number: ";
      }
     ?></label>
     <input type="text" name="phone_numb" value="<?php echo $phone_numb; ?>">

   </div>
   <div class="profile-page-update-input">
     <label>Change Birth Date: </label>
     <input type="date" name="b_date" value="<?php echo $b_date; ?>">

   </div>
   <input type="submit" name="submit" value="Update Info" id="update-info-submit">

</form>
