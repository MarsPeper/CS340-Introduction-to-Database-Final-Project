<?php
 session_start();
 ////require_once "./dblogin.php";
 ?>
<div class="navbar">
   <ul>
      <li>
         <a href="./index.php">
            <i class="fas fa-door-open"></i>
         </a>

      </li>
      <li>
       <form action="./search.php" method="POST">
            <input type="text" name="search" placeholder="Search">
            <button type="submit" name="submit-search" hidden></button>
         </form>
      </li>
      <li>
         <a href="./about.php">About</a>
      </li>
      <li>
         <a href="./jobs.php">Jobs</a>

      </li>
      <!--<li>
         <a href="./search.php">Search</a>

      </li>-->
      <li>
         <a href="./invest.php">Invest</a>

      </li>
      <li>
         <a href="./projects.php">Projects</a>

      </li>

      <?php
      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        echo "<li class='push-right'><a href='./profile.php'>";
        $con = dbconnect();
        $sql = "SELECT name FROM Account WHERE username='" . $_SESSION['user'] . "'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) == 1) {
          $row = mysqli_fetch_array($result);
          echo $row['name'];
        }
        echo "</a></li>";
        echo "<li><a href='./logout.php'>Log Out</a></li>";

      }
      else {
         echo "<li class='push-right'><a href='./create_account.php'>Create Account</a></li>";
         echo "<li><a href='./login.php'>Log In</a></li>";

      }
      ?>
   </ul>
</div>
