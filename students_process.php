<?php
session_start();
include 'db_connect.php'; 
$con=connect();
$stuid=trim($stuid=$con->real_escape_string($_REQUEST['stuid']));
$spassword=trim($spassword=$con->real_escape_string($_REQUEST['stupass']));
$passpass=$spassword;


$_SESSION['sid']=$stuid;
$_SESSION['spasswd']=$spassword;


$sql="SELECT * FROM students WHERE stuid='$stuid' AND password='$spassword'";
$result=mysqli_query($con,$sql);
$c=mysqli_num_rows($result);

if($c==1)
{
	while($row=$result->fetch_assoc())
			{
				$_SESSION['sname']=$row["Name"];
				
			}
	if($spassword=='ditu')
	{
		echo "<script language=\"JavaScript\">\n";
		echo "alert('Please change your password');\n";
		echo "window.location='first_stu_pass.php'";
		echo "</script>";
	}
	if($spassword!='ditu')
	{
	header('Location: students.php');
	}
}
else
{
	echo "<script language=\"JavaScript\">\n";
	echo "alert('Username or Password was incorrect!');\n";
	echo "window.location='index.html'";
	echo "</script>";
	
}
 
 
disconnect($con); 
?>