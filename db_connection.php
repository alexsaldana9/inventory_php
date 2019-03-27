<?php
function OpenCon() {
  $isSchoolVm = false;
  $dbhost = "localhost";
  $dbuser = "admin";
  $dbpass = "ldGLW9MNpSRb";
  $db = "inventory";

  if ($isSchoolVm){
  	$dbuser = "root";
  	$dbpass = "password";
  }

  $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
   
  return $conn;
}
 
function CloseCon($conn) {
  $conn -> close();
}
   
?>