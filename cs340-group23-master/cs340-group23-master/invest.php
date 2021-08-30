<!DOCTYPE html>
<html lang="en">
<head>
   <?php
   require_once "./.dblogin.php";
   require './head.php';
   session_start();
   ?>

</head>

<body>
  <?php
  require './navbar.php'
  ?>
  <div class = "content">
       <h1>Investment Profile</h1>
       <div class="create-project-button">
          <a href="./make_investment.php">Make an investment</a>
       </div>
       <div class= "account-info-box">
         <?php
          $conn = dbconnect();
          $sql = "SELECT name FROM Account WHERE username = " . "'" .$_SESSION["user"] . "'";

          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result);
          echo "<div class = \"account-info-header\">";
            echo "<div>";
            echo "Name: " . $row['name'];
            echo "</div>";

            echo "<div>";
            echo "Username: " . $_SESSION["user"];
            echo "</div>";
          echo "</div>";
          dbclose($conn);
          ?>
       </div>
     <div class = "element-list">
         <?php
          $conn = dbconnect();

          $sql = "SELECT i.cid as comp_ID, i.amount, c.name as company, contract FROM Invest as i JOIN Account as a ON i.username = a.username JOIN Company as c ON i.cid = c.id WHERE a.username = " . "'" .$_SESSION["user"] . "'";

          $result = mysqli_query($conn, $sql);

          $temp_count = 0;
          if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
                 $temp_count = $temp_count + 1;
                 echo "<div class = 'example-element'>";

                   echo "<div>";
                   echo "Investment " . $temp_count . ": " . $row['company'];
                   echo "</div>";

                   echo "<div>";
                   echo "Amount: " . $row['amount'];
                   echo "</div>";

                   echo "<div>";
                   echo "Contract: " . $row['contract'];
                   echo "</div>";
                 echo "</div>";
            }
          }

          dbclose($conn);
          ?>
  </div>

</body>

</html>
