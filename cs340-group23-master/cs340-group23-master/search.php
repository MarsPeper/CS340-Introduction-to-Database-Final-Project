<?php
    require_once "./.dblogin.php";
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
   <div class="content">
     <h1>Job Listings</h1>
     <div class="element-list">
      <?php
      $con = dbconnect();
        if(isset($_POST['submit-search']))
        {
          $search = mysqli_real_escape_string($con, $_POST['search']);
          $sql = "SELECT temp_jobs.id, temp_jobs.title, temp_jobs.description, temp_jobs.list_date, temp_jobs.salary, Company.name FROM Job_listing AS temp_jobs LEFT JOIN Company ON temp_jobs.cid=Company.id WHERE temp_jobs.title LIKE '%$search%' OR temp_jobs.list_date LIKE '%$search%' OR temp_jobs.description LIKE '%$search%' OR temp_jobs.salary LIKE '%$search%' OR Company.name LIKE '%$search%'"; 
          
          $result = mysqli_query($con,$sql);
          $queryResult = mysqli_num_rows($result);

          if($queryResult > 0)
          {
            while($row = mysqli_fetch_array($result)) {
              echo "<div class='example-element'>";
              echo "<div> Company: " . $row['name'] . "</div>";
              echo "<div> Position: " . $row['title'] . "</div>";
              echo "<div> Salary: " . $row['salary'] . "</div>";
              echo "<div> Description: " . $row['description'] . "</div>";
              echo "<div> Date Listed: " . $row['list_date'] . "</div>";
              echo "<a href=./delete-post.php?id=".$row['id'].">Delete</a>";
              echo "<a href=./edit_post.php?id=".$row['id'].">Edit</a>";
              echo "</div>";
            }
          }
          else
          {
            echo "No results that match, sorry :[. Please try again";
          }
        }
      ?>
    </div>

</div>
</body>

</html>
