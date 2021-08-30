<?php
    require_once "./.dblogin.php";
    session_start();
    $con = dbconnect();
    $comp_ID = $_GET['comp_ID'];

    $temp_user = $_SESSION["user"];
    $sqldelete = "DELETE FROM Invest WHERE cid = '$comp_ID' AND username ='$temp_user'";

    $deletePost = mysqli_query($con, $sqldelete);
    if($deletePost)
    {
      $message = "CID check: ". $comp_ID . "User session variable check:" . $temp_user;
      echo "<script type='text/javascript'>alert('$message');</script>";
      header("refresh:0; url=invest.php");
    }
    else
    {
      $message = "Invesment deletion error.";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
    dbclose($con)
?>
