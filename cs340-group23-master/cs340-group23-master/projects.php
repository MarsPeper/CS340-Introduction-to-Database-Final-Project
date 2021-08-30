<!DOCTYPE html>
<html lang="en">
<head>
   <?php
   session_start();
   require_once "./.dblogin.php";
   require './head.php';
   ?>

</head>
<body>
   <?php
   require './navbar.php'
   ?>
    <div class="content">
      <h1>My Projects</h1>
      <div class="create-project-button"> 
         <a href="./create_project.php">Create Project</a>
      </div> 
      <div class= "account-info-box">
        <?php
        $conn = dbconnect();
        $sql = "SELECT name FROM Account WHERE username = " . "'" .$_SESSION["user"] . "'";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        echo "<div class = 'account-info-header'>";
          echo "<div> Name: " . $row['name'] . "</div>";
          echo "<div> Username: " . $_SESSION["user"] . "</div>";
        echo "</div>";
        dbclose($conn);
        ?>
      </div>
      <div class="element-list">
        <?php
        $conn = dbconnect();

        $sql = "SELECT p.name as pname, p.description, p.alt_link, p.id, a.name as owner FROM Project as p JOIN Account as a ON p.owner = a.username WHERE a.username = " . "'" .$_SESSION["user"] . "'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_array($result)) {
            echo "<div class='example-element'>"; 
            echo "<div> Project: " . $row['pname'] . "</div>";
            echo "<div> Description: " . $row['description'] . "</div>";
            echo "<div> Author: " . $row['owner'] . "</div>";
            echo "<a href=./delete_project.php?id=".$row['id'].">Delete</a>";
            echo "</div>";
          }
        }
        dbclose($conn);
        ?>
      </div>
    </div>
</body>

</html>
