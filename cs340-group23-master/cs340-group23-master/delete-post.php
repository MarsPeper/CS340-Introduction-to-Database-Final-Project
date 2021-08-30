<?php
    require_once "./.dblogin.php";
    $con = dbconnect();

    $postID = $_GET['id'];
    $msg = "test";
    $sqldelete = "DELETE FROM Job_listing WHERE id='$postID'";

    $deletePost = mysqli_query($con, $sqldelete);
    if($deletePost)
    {
      header("refresh:0; url=jobs.php");
    }
    else
    {
      echo "Not deleted,";
      echo " id:" . $postID . "";
    }
    dbclose($con)
?>