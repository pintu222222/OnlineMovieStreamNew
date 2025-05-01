<?php
  $conn = mysqli_connect("localhost","root","","fmdiaries_database");
  if(! $conn ) {
      die('Could not connect: ' . mysqli_error());
   }
?>
