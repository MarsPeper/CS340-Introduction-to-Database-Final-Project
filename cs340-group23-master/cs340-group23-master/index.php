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
  <div class="header">
     <?php
      if(isset($_SESSION["loggedin"])) echo '<br><br><br>';

      ?>
     <h1>Braden's List</h1>
     <?php
      if(!isset($_SESSION["loggedin"])) {
         echo '<div class="header-link"><a href="./create_account.php">Create Account</a></div>';
         echo '<div class="header-link"><a href="./login.php">Login</a></div>';
      }
      ?>
  </div>
   <div class="content">
      <div class="job-listing-preview">
         <h3>Job Listings</h3>
         <?php
          $conn = dbconnect();


          $sql = "SELECT jl.list_date as date, jl.title, jl.description, jl.salary, c.name FROM Job_listing as jl JOIN Company as c ON jl.cid = c.id ORDER BY date DESC LIMIT 20";

          $result = mysqli_query($conn, $sql);

          if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
               echo '<div class="job-listing-preview-item">';
               echo '<h4>' . $row['title'] . '</h4>';
               echo '<p>' . substr($row['description'], 0, min(strlen($row['description']), 30)) . '... </p>';
               echo '<p>Salary: $' .$row['salary'] . '. </p>';
               echo '<p>Posted by ' . $row['name'] . ' on ' . date("l F j, Y", strtotime($row['date'])) . '.</p>';
               echo "</div>";
            }
          }

          ?>
      </div>
      <div class="index-row">
      <div class="project-preview">
         <h3>Projects</h3>
         <?php
          $sql =
          "SELECT p.name as pname, p.description, p.alt_link, a.name as owner FROM Project as p JOIN Account as a ON p.owner = a.username LIMIT 3";

          $result = mysqli_query($conn, $sql);

          if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {

               echo "<div class='project-preview-item'>";
               echo "<a href=" . $row['alt_link'] . "><h4>" . $row['pname'] . "</h4></a>";
               echo "<p>" . $row['description'] . "</p>";
               echo "<p> By " . $row['owner'] . "</p>";
               echo "</div>";


            }
          }



          ?>
      </div>
      <div class="invest-preview">
         <h3>Investments</h3>
         <?php
          $sql = "SELECT a.name as investor, i.amount, c.name as company FROM Invest as i JOIN Account as a ON i.username = a.username JOIN Company as c ON i.cid = c.id LIMIT 7";

          $result = mysqli_query($conn, $sql);

          if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
               echo "<p>";
               echo $row['investor'] . " invested $";
               echo $row['amount'] . " in ";
               echo $row['company'];
               echo "</p>";
            }
          }

          dbclose($conn);
          ?>
      </div>
      <div class="news">
         <h3>News</h3>
         <p>Welcome to Braden's List <a href="./about.php">Learn About Us Here</a></p>
      </div>
    </div>



   </div>
</body>

</html>
