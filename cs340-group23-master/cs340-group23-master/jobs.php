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
      <h1>Job Listings</h1>
      <div class="create-project-button"> 
      <?php
        $conn = dbconnect();
        //
        //checking the current logged in user if they're employeed and if so, proceeds to grab the cid
        $sqlemployed_1 = "SELECT cid FROM Employ WHERE username = " . "'" .$_SESSION["user"] . "'";
        $resultemployed_1 = mysqli_query($conn, $sqlemployed_1);
        $rowemployed_1 = mysqli_fetch_array($resultemployed_1);
        //echos out the cid grabbed
        //echo "<p>".$rowemployed_1['cid']. "</p>";
        //saves cid variable to call in select statement below

        if(isset($rowemployed_1))
        {
          echo "<a href=./create_post.php?cid=".$rowemployed_1['cid'].">Create Job listing Post</a>";
        }
        dbclose($conn);
        ?>
      </div>  
      <div class= "account-info-box">
        <?php
        $conn = dbconnect();
        //
        //checking the current logged in user if they're employeed and if so, proceeds to grab the cid
        $sqlemployed = "SELECT cid FROM Employ WHERE username = " . "'" .$_SESSION["user"] . "'";
        $resultemployed = mysqli_query($conn, $sqlemployed);
        $rowemployed = mysqli_fetch_array($resultemployed);
        //echos out the cid grabbed
        //echo "<p>".$rowemployed['cid']."</p>";
        //saves cid variable to call in select statement below
        $yesemployed = $rowemployed['cid'];
        //

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
        
        $sql = "SELECT temp_jobs.id, temp_jobs.title, temp_jobs.description, temp_jobs.list_date, temp_jobs.salary, Company.name FROM Job_listing AS temp_jobs LEFT JOIN Company ON temp_jobs.cid=Company.id;";
        //
        //uses the $yesemployed variable in this select statement below to grab the name of the company they're employed to
        $sqlDU = "SELECT id, name FROM Company WHERE id ='$yesemployed'";
        $resultDU = mysqli_query($con, $sqlDU);
        $rowDU = mysqli_fetch_array($resultDU);

        //echos out the id grabbed
        //echo "<p>".$rowDU['id']."test1</p>";
        //echos out the cid previously grabbed above
        //echo "<p>".$rowemployed['cid']."test2</p>";
        //
        $result = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_array($result)) {
            echo "<div class='example-element'>";
            echo "<div> Company: " . $row['name'] . "</div>";
            echo "<div> Position: " . $row['title'] . "</div>";
            echo "<div> Salary: " . $row['salary'] . "</div>";
            echo "<div> Description: " . $row['description'] . "</div>";
            echo "<div> Date Listed: " . $row['list_date'] . "</div>";
            
            //attempt to only show the option to delete/edit only if they're employeed by that current company.
            if($rowDU['name'] == $row['name']){
            echo "<a href=./delete-post.php?id=".$row['id'].">Delete</a><br>";
            echo "<a href=./edit_post.php?id=".$row['id'].">edit</a>";
            }
            echo "</div>";
          }
        }
        dbclose($conn);
        ?>
      </div>
    </div>
</body>

</html>
