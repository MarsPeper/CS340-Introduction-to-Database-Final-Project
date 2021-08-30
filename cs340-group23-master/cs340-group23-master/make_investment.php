<?php
   session_start();
   require_once "./.dblogin.php";
   $success = false;
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
     $amount_in = clean_input($_POST["amount"]);
     $company_id = clean_input($_POST["cid"]);
     $invest_contract = clean_input ($_POST["contract"]);
     $owner = $_SESSION["user"];

     if($invest_contract == "")
     {
       $message = "Invesment contract must not be empty";
       echo "<script type='text/javascript'>alert('$message');</script>";
     }
     else if ($amount_in == 0)
     {
       $message = "Amount of investment must be greater than 0";
       echo "<script type='text/javascript'>alert('$message');</script>";
     }
     else
     {
       $conn = dbconnect();
       $stmt = $conn->prepare("INSERT INTO Invest (username, cid, amount, contract) VALUES ( ?, ?, ?, ?)");
       $stmt->bind_param("siis", $owner, $company_id, $amount_in, $invest_contract);

       if($stmt->execute())
       {
         $success = true;
       }
        $stmt->close();
        dbclose($conn);
        if($success)
        {
           $message = "Investment submission status: Success";
           echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else
        {
          $message = "Investment submission status: Failed. You might have invested in that company already.";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
     }


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
  <div class = "content">
       <h1>Make an investment</h1>
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
     <div class = "invest-list">
         <?php
          $conn = dbconnect();
          $sql = "SELECT id, name, description, type_of_company, link FROM Company";

          $result = mysqli_query($conn, $sql);

          $temp_count = 0;
          if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
                 $temp_count = $temp_count + 1;
                 echo "<div class = \"investment-placeholder\">";

                   echo "<div>";
                   echo "Company name: " . $row['name'];
                   echo "</div>";

                   echo "<div>";
                   echo "Company ID: " . $row['id'];
                   echo "</div>";

                   echo "<div>";
                   echo "Description: " . $row['description'];
                   echo "</div>";

                   echo "<div>";
                   echo "Type of company: " . $row['type_of_company'];
                   echo "</div>";


                   echo "<div>";
                     echo "<a href=\"" . $row['link'] . "\">";
                     echo "Visit " . $row['name'] , "'s website at " . $row['link'];
                     echo "</a>";
                   echo "</div>";

                   echo "<div>";

                   echo "$";
                     echo "<form method=\"post\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) ."\">";
                     echo "<input type=\"number\" name=\"amount\" min=\"0\" id = \"comp_" . $row['id'] . "\">" ;
                     echo "<input type=\"number\" name=\"cid\" value =\"" . $row['id'] . "\" hidden>";
                     echo "<input type=\"text\" name=\"contract\" minlength=\"1\"\>";
                     echo "<input type=\"submit\" value=\"Submit investment\">";

                     echo "</form>";

                   echo "</div>";

                 echo "</div>";

            }
          }

          dbclose($conn);
          ?>
  </div>

</body>

</html>
