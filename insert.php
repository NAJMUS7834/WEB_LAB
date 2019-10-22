<html>

<body>

<?php

$con = mysql_connect("localhost","root","","sort");

if (!$con)

  {

  die('Could not connect: ' . mysql_error());

  }

 

mysql_select_db("sort", $con);

 

$sql="INSERT INTO students (usn, name,sem)

VALUES

('$_POST[usn]','$_POST[name]','$_POST[sem]')";

 

if (!mysql_query($sql,$con))

  {

  die('Error: ' . mysql_error());

  }

echo "1 record added";

 

mysql_close($con)

?>
<center><a href="10.php">Relod</a></center>
</body>

</html>
