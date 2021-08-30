<?php
 session_start();
 $user = $_SESSION["user"];
 $cid = $cname = $title = $date_employed = "";

 if($_SERVER["REQUEST_METHOD"] == "POST") {
    require "./.dblogin.php";

    $con = dbconnect();
    $cid = $_POST["company"];
    $title = $_POST["title"];
    $date_employed = $_POST['date_employed'];


    $stmt = $con->prepare("INSERT INTO Employ (cid, username, date_employed, title) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("isss", $cid, $user, $date_employed, $title);

    if($stmt->execute()) {

       $stmt->close();
    }


    dbclose($con);

    header('location: profile.php?tab=employment');
    exit;

 }
 else if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete'])) {
    require "./.dblogin.php";
    $cid = $_GET["delete"];

    $con = dbconnect();
    $sql = "SELECT cid FROM Employ WHERE username=? AND cid=?";

    if($stmt = mysqli_prepare($con, $sql)) {
       mysqli_stmt_bind_param($stmt, "si", $user, $cid);

       if(mysqli_stmt_execute($stmt)) {
         mysqli_stmt_store_result($stmt);

         if(mysqli_stmt_num_rows($stmt) == 1) {
           mysqli_stmt_bind_result($stmt, $cid);
           mysqli_stmt_fetch($stmt);

           $sql = "DELETE FROM Employ WHERE cid=? AND username=?";


           if($stmt2 = mysqli_prepare($con, $sql)) {
              mysqli_stmt_bind_param($stmt2, "is", $cid, $user);
              mysqli_stmt_execute($stmt2);
              mysqli_stmt_close($stmt2);
           }

         }
       }

    }

    mysqli_stmt_close($stmt);

    dbclose($con);
    header('location: profile.php?tab=employment');
    exit;


 }
 else {
   $con = dbconnect();

   $sql = "SELECT c.name, e.cid, e.title, e.date_employed FROM Employ as e JOIN Company as c ON e.cid = c.id WHERE e.username = ?";

   if($stmt = mysqli_prepare($con, $sql)) {

      mysqli_stmt_bind_param($stmt, "s", $user);

      if(mysqli_stmt_execute($stmt)) {
         mysqli_stmt_store_result($stmt);

         if(mysqli_stmt_num_rows($stmt) > 0 ) {
            mysqli_stmt_bind_result($stmt, $cname, $cid, $title, $date_employed);
            mysqli_stmt_fetch($stmt);


         }

      }
      mysqli_stmt_close($stmt);
   }

   dbclose($con);

   echo "<h2>Employment</h2>";

   if(empty($cid)) {
      echo "<p>You are currently unemployed<p>";
      echo '<div class="employment">';
      echo '<form method="POST" action="employment.php">';
      echo '<select name="company">';

      $con = dbconnect();
      $sql = "SELECT id, name, type_of_company FROM Company";
      $result = mysqli_query($con, $sql);

      while($company = mysqli_fetch_array($result)) {
         echo "<option value='" . $company['id'] . "'>";
         echo $company['name'] . " <span>" . $company['type_of_company'] . "</span>";
         echo "</option>";

       }

       dbclose($con);

       echo '</select>';
       echo '<input type="date" name="date_employed">';
       echo '<input type="text" name="title" placeholder="Title at Company">';
       echo '<input type="submit" name="submit" value="Add Employer">';
       echo '</form></div>';


   }
   else {
     echo "<div class='employment'>";
     echo "<p>You are employed by the company " . $cname . " as a(n) ";
     echo $title . ". </p><p> Date Employment began: <span>" . $date_employed . "</span>";
     echo "<a href='employment.php?delete=" . $cid . "'><i class='fas fa-times'></i></a>";
     echo "</p></div>";




   }


}
?>
