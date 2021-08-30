<?php
 session_start();
 require_once "./.dblogin.php";
 $postcid = "";
 $success = false;
 $error = false;
 $err = array();
 //$postID = $_GET['id'];
 if($_SERVER["REQUEST_METHOD"] == "POST") {

     $title = clean_input($_POST["title"]);
     if(empty($title)) {
       array_push($err, "titleempty");
     }

     $description = clean_input($_POST["description"]);
     if(empty($description)) {
        array_push($err, "descriptionempty");
     }

     $salary = clean_input($_POST["salary"]);
     if(empty($salary)) {
        array_push($err, "salaryempty");
     }

     $list_date = clean_input($_POST["list_date"]);
     if(empty($list_date)) {
       array_push($err, "list_dateempty");
     }

     $postcid = $_POST['cid'];

     //echo "<p>".$postcid."</p>";
     if(!sizeof($err)) {
        $conn = dbconnect();

        $stmt = $conn->prepare("INSERT INTO Job_listing (title, description, salary, list_date, cid) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $description, $salary, $list_date, $postcid);

        if($stmt->execute()) {
           $success = true;
        }

        $stmt->close();
        dbclose($conn);

     }
 }
 else if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["cid"])) {
   $postcid = $_GET["cid"];


}

 if($success) {
    header('location: jobs.php');
    exit;
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
   require './navbar.php';
   ?>
   <div class="content">
      <div class="create-project">
         <h1>Create a Job Post</h1>
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="create-project-input">
               <?php $error = in_array("titleempty", $err); ?>
               <label>Title:</label><br>
               <input type="text" name="title" <?php if($error) echo 'class="input-error"'; ?>>
            </div>
            <div class="create-project-input">
               <?php $error = in_array("descriptionempty", $err); ?>
               <label>Description:</label><br>
               <input type="text" name="description" <?php if($error) echo 'class="input-error"'; ?>>
            </div>
            <div class="create-project-input">
               <?php $error = in_array("list_dateempty", $err); ?>
               <label>list_date:</label><br>
               <input type="text" name="list_date" <?php if($error) echo 'class="input-error"'; ?>>
            </div>
            <div class="create-project-input" id="create-project-description">
               <?php $error = in_array("salaryempty", $err); ?>
               <label>Salary:</label><br>
               <input type="text" name="salary" <?php if($error) echo 'class="input-error"'; ?>>
            </div>  
            <input type="hidden" name="cid" value="<?php echo $postcid; ?>">
            <input type="submit" value="Create Jobs" id="create-job-post-submit">
         </form>
      </div>
   </div>

</body>

</html>
