<?php
//INCLUDE THIS FILE IN ANY SCRIPT YOU WRITE require "./config.php";


require_once "./.dblogin.php"; //Functions to log in to the database
require_once "./_queries.php"; //All queries should go here 




//To log in to the database:

//$dblink = dbconnect();
//{Run your queries and operations}
//dbclose($dblink);

//IT IS VERY IMPORTANT THAT YOU CLOSE THE CONNECTION TO DATABASE BEFORE
//THE PHP FILE YOU ARE WRITING ENDS. THIS MINIMIZES THE USE OF GLOBAL 
//VARIABLES AND POTANTIAL CONFLICTS.




//YOUR ONID USERNAME GOES HERE FOR EXAMPLE: $_ONID="walshb";

$_ONID="walshb";

//You should also use this whenever you need to specify the entire url of
//the application. For actual links within the webite please just use the
//name of the file. For example: href="./index.php"

//This is only useful when using the header() function within a php script.
//For example:
// header("Location: http://web.engr.oregonstate.edu/~" . $_ONID . "/cs340-group23/index.php");



?>
