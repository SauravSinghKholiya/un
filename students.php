<?php
session_start();
$id;
if(isset($_SESSION['sid']) && isset($_SESSION['spasswd']))
{ 
	
		include 'db_connect.php'; 
			$con=connect();
			$id=$_SESSION['sid'];
			
			$password=$_SESSION['spasswd'];
			
			$sql="SELECT * FROM students WHERE stuid='$id' AND password='$password'";
			$result=mysqli_query($con,$sql);
			if($result->num_rows===1)
			{
				while($row=$result->fetch_assoc())
				{
					$name=$row['Name'];
?> 

<!DOCTYPE html>
<html>
<head>
	<title>Students</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	function insert()
	{
		var regexp1=/^[^<>/"=';!@#$%+()-]+$/;
		var regexp2=/^(?=.*?[a-z]).{1,}$/;
		var pass=document.myform.subj.value;
		if(regexp1.test(pass) && regexp2.test(pass))
		{
			if(window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}
			else {
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange =  function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					document.getElementById("message").innerHTML = xmlhttp.responseText;
				}
			}
			parameters = "text="+document.getElementById("subj").value+"&selectnotes="+document.getElementById("sel1").value;
			
			xmlhttp.open("POST", "view_uploaded_notes.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send(parameters);
		}
		else{
			alert("Enter alpahbets and numbers.");
		}
	}
	function papers()
	{
		if(window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}
		else {
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange =  function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("tablediv").innerHTML = xmlhttp.responseText;
			}
		}
		parameters = "text="+document.getElementById("submitt").value;
		
		xmlhttp.open("POST", "view_exam_papers.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send(parameters);
	}
	</script>
  
  <style>
  body {
      position: relative; 
  }
  carousel { margin: 0; 
			position: relative; }
  .affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
  }
  .navbar {
      margin-bottom: 0px;
	  border-radius: 0;
	  background: linear-gradient(black, #2a2727);
  }

  .affix + .container-fluid {
      padding-top: 70px;
  }
  #section1 {padding:0px;
			color: #fff; 
			background-color: white;
			margin: 0; }
	#lowerbody {background-color: #2a2727; }
   #articles{  padding: 0; 
				background-color: #212727 }
	#events { padding: 0; 
				background-color: #eee; color: #2a2727; }
		
   #notes { padding: 0;
			background-color: #212727;
			}
	.note { background: linear-gradient(rgb(42,101,247), #2a2727);
			margin: 0; padding-right: 8px; 
			border-radius: 8px;
			width: 100%; height: 35px;  }
	.news { background: linear-gradient(black, #2a2727); height: 30px;
			width: 100%; }
	.uploads { background: linear-gradient(red, maroon);
			margin: 0; padding: 0; 
			border-radius: 8px;
			color: white;
			font-weight: bold;
			font-size: 1.2em;
			width: 100%; height: 25px;  }
   footer { background-color: #2a2727; color: white;  }
   #searchsubform { padding-right: 90px; padding-left: 50px;}
  form { padding: 5px; }
  li:hover { background-color: orange;}
  
  #srchul { background-color: #eff;
	cursor: pointer;
	border: .05px solid grey;
	border-radius: 0;
	position: relative;
    width: 100%;
}
#srchli {
	color: black;
	width: 100%;
	background-color: white;
	padding: 10px;
	font-size: 0.9em;
	border-bottom: .05px solid grey;
	border-radius: 0;
	padding: 10px;
}
#srchli:hover {
    background-color: grey;
	border-radius: 0;
	color: white;
}
#bottom_manage { color: black; text-align: center;
 background-color:#ffd; height: 200px;
 padding: 10px; 
 border-radius: 5px;
}
#viewimagediv { border-radius: 5px; margin: 5px; background-color: #eee; 
				width: 96%;
				 box-shadow: 5px 5px 3px grey;}
a.filelink:hover { text-decoration: none; color: red; font-size: 25px; 
}
#srcimg { margin: 2px;  width: 30%; }
.glyphicon.glyphicon-file { font-size: 20px; }
#carouselcaption { padding: 10px; }
#tablediv { background-color: #eee;
			margin: 5px;
			padding: 10px; }
#contacts { background-color: #eee; 
margin: 0; padding: 0;
	} 
  </style>
  

  
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">

<div class="container-fluid" style="background: linear-gradient(black, #2a2727); color:#fff;height:100px;">
  <h1>UniversityNetwork</h1>
 </div>

<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="197">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand" href="#">UniversityNetwork</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Students</a></li>
				<li><a href="changex-master/links1.html"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Links</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-question-sign"></span></a></li>
			</ul>
		</div>
	</div>
</nav>  




<!-- LOWER BODY -->


<div id="lowerbody" class="container-fluid text-center">    
	<div class="row">
		
		<div id="notes" class="col-sm-8">
			<header class="note">
				<form class="navbar-form navbar-right" role="search" id="searchsubform" name="myform">
					<div class="form-group">
						 <select class="form-control input-sm"  name="selectnotes" id="sel1">
							<option>notes</option>
							<option>images</option>
						</select>
					</div>
					<div class="form-group input-group">
						<input type="text" class="form-control input-sm" name="subj" id="subj" onfocus="this.value=''" placeholder="Search Subject..">
						 <span class="input-group-btn">
							<button class="btn btn-default input-sm" type="button" onclick="insert();">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>    
					</div>
					<div id="subList" style="color: black; background-color: white;"></div>
				</form>
			</header><br><br><br>
			
			<div id="message"></div>
			
			<div class="jumbotron" style="width: 95%; margin: 10px;">
				<h1>NOTES BODY</h1> 
				<p>All the uploaded notes are available here. The latest updated notes are shown first in the list
				 as per the selected subject.</p> 
			</div>
			<br><br><br><br><br><br><br><br><br>
		</div>
		<div id="articles" class="col-sm-4" style="height: 100%;">
			<header class="uploads">NOTICE</header><br>
			<div class="jumbotron" style="width: 95%; margin: 10px; color: black; font-weight: bold;">
				<h3>Recent Notice</h3> 
				<h4><small>This notice is regarding recent updates made in the website. If any recent update is made, users are informed
				through this notice. If there are no updates, this is kept blank. <br> Thank you.</small></h4> 
			</div><br>

			<br><br><br><br>
		</div>
	</div>
	<div class="row">
		<div id="papers" class="col-sm-6">
			<header class="uploads">Exam Papers..</header>
			<div class="jumbotron" style="width: 95%; margin: 10px; color: black; font-weight: bold;">
				<h3>VIIEW EXAM PAPERS...</h3> 
				<h4><small>All the past year University Papers are updated here ordered by subject name. Press view to see all the papers.</small></h4> 	
			</div>
			<button class="btn btn-primary" style="clear: both; width: 50%; color: white; height: 30px; font-size: 13px;" id="submitt" value="submit"
			onclick="papers();"><strong>VIEW  EXAM  PAPERS</strong></button><br>
			<div class="container-fluid" id="tablediv"></div>
		</div>
		<div id="events" class="col-sm-6"  style="height: 100%;">
			<header class="news"></header>
			<h2>College Events and Updates</h2><br>
			<div id="myCarousel1" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner" id="noticeback">
						
				</div>

				<script type="text/javascript">
				$(document).ready(function(){
				$("#noticeback").load("view_events.php");
				});
				</script>
				<a class="left carousel-control" href="#myCarousel1" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel1" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		
	</div>
</div>
<div class="container-fluid" id="contacts" style="color: black;">
	<h3 class="text-center" style="color: #012;"><strong>CONTACTS</strong></h3>
	<div class="row test" style="margin: 0; padding: 0;">
		<div class="col-md-4">
		<br><br>
			<h3 style="color: #012;"><strong>UniversityNetwork</strong></h3>
			<p><span class="glyphicon glyphicon-map-marker"></span>Dehradun, India</p>
			<p><span class="glyphicon glyphicon-phone"></span>Phone1: +91 8979617247</p>
			<p><span class="glyphicon glyphicon-phone"></span>Phone2: +91 7500912925</p>
			<p><span class="glyphicon glyphicon-envelope"></span>Email: UniversityNetwork@gmail.com</p> 
		</div>
		<div class="col-md-8">
			<br><br>
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">Saurav Singh Kholiya</a></li>
				<li><a data-toggle="tab" href="#menu1">Sankalp Rusia</a></li>
			</ul>

			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
					<h3>Saurav Singh Kholiya</h3>
					<p>We want to support all our fellow students and provide them with all the notes.<br>
						For any problem regarding this website please contact us. Thank you.</p>
					<ul><li>Student at DIT University, Dehradun.</li>
						<li>Btech. CSE-A, Batch 2016-2020.</li>
						<li><span class="glyphicon glyphicon-phone"></span>&nbsp;Mob.: +91 8979617247</li>
						<li><i class="fa fa-github" style="font-size: 18px;"></i>&nbsp;</li>
					</ul>
				</div>
				<div id="menu1" class="tab-pane fade">
					<h3>Sankalp Rusia</h3>
				<p>We want to support all our fellow students and provide them with all the notes.<br>
						For any problem regarding this website please contact us. Thank you.</p>
					<ul><li>Student at DIT University, Dehradun.</li>
						<li>Btech. CSE-A, Batch 2016-2020.</li>
						<li><span class="glyphicon glyphicon-phone"></span>&nbsp;Mob.: +91 7500912925</li>
						<li><i class="fa fa-github" style="font-size: 18px;"></i>&nbsp;</li>
					</ul>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<footer class="container-fluid">
 <p>All rights reserved. UniversityNetwork &copy; 2018-2021</p>
</footer>


</body>
</html>

<script>
$(document).ready(function() {
	$('#subj').keyup(function() {
		var query = $(this).val();
		if(query!='')
		{
			$.ajax({url: 'search_sub.php',
			method: 'POST',
			data: {query:query},
			success: function(data)
			{
				$('#subList').fadeIn();
				$('#subList').html(data);
			}
			});
		}
		else
		$('#subList').html('');
	});
	$(document).on('click','li',function() {
		$('#subj').val($(this).text());
		$('#subList').fadeOut();
	});
});
</script>

<?php
		}
	}
}
else
{
	echo "<script language=\"JavaScript\">\n";
echo "alert('Log in please!');\n";
echo "window.location='index.html'";
echo "</script>";
} 
?>