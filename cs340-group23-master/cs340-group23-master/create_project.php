<?php
 session_start();
 require_once "./.dblogin.php";

 $success = false;
 $error = false;
 $err = array();
 if($_SERVER["REQUEST_METHOD"] == "POST") {

     $name = clean_input($_POST["name"]);
     if(empty($name)) {
       array_push($err, "nameempty");
     }

     $link = clean_input($_POST["link"]);
     if(empty($link)) {
        array_push($err, "linkempty");
     }

     $description = clean_input($_POST["description"]);
     if(empty($description)) {
        array_push($err, "descempty");
     }

     $owner = $_SESSION["user"];

     if(!sizeof($err)) {
        $conn = dbconnect();

        $stmt = $conn->prepare("INSERT INTO Project (name, description, alt_link, owner) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $description, $link, $owner);

        if($stmt->execute()) {
           $success = true;
        }

        $stmt->close();
        dbclose($conn);

     }
 }

 if($success) {
    header('location: projects.php');
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
         <h1>Create a Project</h1>
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="create-project-input">
               <?php $error = in_array("nameempty", $err); ?>
               <label>Name:</label><br>
               <input type="text" name="name" <?php if($error) echo 'class="input-error"'; ?>>
            </div>
            <div class="create-project-input">
               <?php $error = in_array("linkempty", $err); ?>
               <label>Link:</label><br>
               <input type="text" name="link" <?php if($error) echo 'class="input-error"'; ?>>
            </div>
            <div class="create-project-input" id="create-project-description">
               <?php $error = in_array("descempty", $err); ?>
               <label>Description:</label><br>
               <input type="text" name="description" <?php if($error) echo 'class="input-error"'; ?>>
            </div>
            <input type="submit" value="Create Project" id="create-project-submit">
         </form>
      </div>
   </div>

</body>

</html>
