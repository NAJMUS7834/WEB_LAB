<html>
<head>
<style>
table,td,th {
	border:1px solid black;
	text-align:center;
	border-collapse:collapse;
	background-color:lightblue;
	font: 95% Arial, Helvetica, sans-serif;
	max-width: 400px;
	margin: 10px auto;
	padding: 16px;
	background: #F7F7F7;
}
table {
	margin:auto;
	font: 95% Arial, Helvetica, sans-serif;
	max-width: 400px;
	margin: 10px auto;
	padding: 16px;
	background: #F7F7F7;
}
.form-style-6{
	font: 95% Arial, Helvetica, sans-serif;
	max-width: 400px;
	margin: 10px auto;
	padding: 16px;
	background: #F7F7F7;
}
.form-style-6 h1{
	background: #43D1AF;
	padding: 20px 0;
	font-size: 140%;
	font-weight: 300;
	text-align: center;
	color: #fff;
	margin: -16px -16px 16px -16px;
}

.form-style-6 input[type="submit"],
.form-style-6 input[type="button"]{
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	width: 100%;
	padding: 3%;
	background: #43D1AF;
	border-bottom: 2px solid #30C29E;
	border-top-style: none;
	border-right-style: none;
	border-left-style: none;	
	color: #fff;
}
.form-style-6 input[type="submit"]:hover,
.form-style-6 input[type="button"]:hover{
	background: #2EBC99;
}
</style>
</head>
<body>
<div class="form-style-6">
<h1>Student Details</h1>
<form action="insert.php" method="post">
<input type="varchar" name="field1" placeholder="USN" />
<input type="varchar" name="field2" placeholder="NAME" />
<input type="INT"     name="sem" placeholder="SEM"/><br>
<input type="submit"  />
</form>

<?php
$servername="localhost";
$username="root";
$password="";
$dbname="sort";
$a=[];
$conn=mysqli_connect($servername,$username,$password,$dbname);
if($conn->connect_error)
	die("Connection failed:".$conn->connect_error);

$sql="SELECT * FROM students";
$result=$conn->query($sql);
echo"<br>";
echo"<center><h1>BEFORE SORTING</h1></center>";
echo"<table border='2'>";
echo"<tr>";
echo"<th>USN</th><th>NAME</th><th>SEM</th></tr>";
if($result->num_rows>0)
{
	while($row=$result->fetch_assoc()){
		echo"<br>";
		echo"<td>".$row["usn"]."</td>";
		echo"<td>".$row["name"]."</td>";
		echo"<td>".$row["sem"]."</td></tr>";
		array_push($a,$row["usn"]);
	}
}
else
	echo"Table is empty";
echo"</table>";
$n=count($a);
$b=$a;
for($i=0;$i<($n-1);$i++)
{
	$pos=$i;
	for($j=$i+1;$j<$n;$j++) {
		if($a[$pos]>$a[$j])
			$pos=$j;
	}
	if($pos!=$i) {
		$temp=$a[$i];
		$a[$i]=$a[$pos];
		$a[$pos]=$temp;
	}
}
$c=[];
$d=[];
$result=$conn->query($sql);
if($result->num_rows>0) 
{
	while($row=$result->fetch_assoc()) {
		for($i=0;$i<$n;$i++) {
			if($row["usn"]==$a[$i]) {
				$c[$i]=$row["name"];
				$d[$i]=$row["sem"];
			}
		}
	}
}
echo"<br>";
echo"<center><h1>AFTER SORTING</h1></center>";
echo"<table border='2'>";
echo"<tr>";
echo"<th>USN</th><th>NAME</th><th>SEM</th></tr>";
for($i=0;$i<$n;$i++) {
	echo"<tr>";
	echo"<td>".$a[$i]."</td>";
	echo"<td>".$c[$i]."</td>";
	echo"<td>".$d[$i]."</td></tr>";
}
echo"<table>";
$conn->close();
?>
</div>
</body>
</html>
