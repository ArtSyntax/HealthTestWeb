<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Health Test</title>
  <link href="img/icon.png" rel="shortcut icon" type="image/x-icon">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
</head>

<body>
	<nav class="white" role="navigation" id="home">
		<div class="nav-wrapper container">
			<a id="logo-container" href="index.html" class="brand-logo"> <img src="img/logo.png" alt="HealthTest" height="60" width="60"> </a>
			<ul class="right hide-on-med-and-down">
				<li><a href="index.html#home">Home</a></li>
				<li><a href="index.html#about">About</a></li>
				<li><a href="#contact">Contact</a></li>
				<li><a href="preregis.php">Pre-regis</a></li>
				<li><a href="result.php">Result</a></li>
			</ul>

			<ul id="nav-mobile" class="side-nav">
				<li><a href="index.html#home">Home</a></li>
				<li><a href="index.html#about">About</a></li>
				<li><a href="#contact">Contact</a></li>
				<li><a href="preregis.php">Pre-regis</a></li>
				<li><a href="result.php">Result</a></li>
			</ul>
			<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
		</div>
	</nav>
	
	<div class="container" id="input">
		<div class="section">
			<div class="row">
				<div class="col s12 center">
				<h2 class="header center teal-text text-lighten-2">Result</h2>
					<div class="row">
						<form class="col s12 m6 offset-m3" method="post" action="show_score.php">
							<div class="row">
								<div class="input-field col s12">	
									<input id="id" name="id" type="text" class="validate" required>
									<label for="id">ID</label>
								</div>
								<div class="input-field col s12">	
									<button class="btn btn-large waves-effect waves-light" type="submit" name="action">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>	
	
	<div class="container" id="person_result">
		<div class="section">
			<div class="row">
				<div class="col s12 m6 offset-m3 center">
					<h3><i class="medium material-icons brown-text">equalizer</i></h3>
					<h4>Personal result</h4>
					<ul class="collection with-header">
						
						<?php									
							$host = "localhost";
							$user = "art";
							$pass = "art12345678";
							$dbname="healthTest"; 
							
							$conn=mysql_connect($host,$user,$pass) or die("Can't connect");
							mysql_select_db($dbname) or die(mysql_error()); 
							mysql_query("SET NAMES UTF8");
							$data = mysql_query("SELECT T.firstname, T.lastname, T.test_name, T.station_name, score, T.station_unit, T.date
											FROM RESULT TMP
											INNER JOIN (
											SELECT USER.firstname, USER.lastname, TEST.test_name, STATION.station_name, STATION.station_unit, MAX( RESULT.date ) AS date
											FROM RESULT
												INNER JOIN USER ON RESULT.user_id = USER.user_id
												INNER JOIN TEST_STATION ON RESULT.test_station_id = TEST_STATION.test_station_id
												INNER JOIN TEST ON TEST.test_id = TEST_STATION.test_id
												INNER JOIN STATION ON STATION.station_id = TEST_STATION.station_id
												WHERE USER.id = '".$_GET['id']."'
												GROUP BY RESULT.test_station_id)T
											ON T.firstname = firstname
											AND T.lastname = lastname
											AND T.test_name = test_name
											AND T.station_name = station_name
											AND T.station_unit = station_unit
											AND T.date = TMP.date")
									or die(mysql_error()); 
									
							$rows = array();
							while($r = mysql_fetch_assoc($data)) {
								$rows[] = $r;
							}
							
							$jsonTable = json_encode($rows);		
							$json_output = json_decode($jsonTable); 
							$firsttime = true;
							foreach ($json_output as $key)  
							{	
								if($firsttime)
								{
									print "<li class=\"collection-header center teal lighten-2 white-text text-lighten-2\">";
									print "<h3>{$key->firstname} {$key->lastname}</h3>";
									print "</li>";
									$firsttime=false;
								}
								
								print "<li class=\"collection-item brown-text\"><h5>{$key->station_name}: {$key->score} {$key->station_unit}</h5></li>";
								//print "<a href=\"#!\" class=\"collection-item brown-text\"><h5>{$key->station_name}: {$key->score} {$key->station_unit}</h5></a>";
							} 	
							
							
								
						
						?>
					
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container" id="overall_result">
		<div class="section">
			<div class="row">
				<div class="col s12 center">
					<h3><i class="medium material-icons brown-text">trending_up</i></h3>
					<h4>Overall result</h4>
					
				</div>
			</div>
		</div>
	</div>	
	
	<div class="container" id="execution">
		<div class="section">
			<div class="row">
				<div class="col s12 center">
					<h3><i class="medium material-icons brown-text">loop</i></h3>
					<h4>Execution</h4>
					
				</div>
			</div>
		</div>
	</div>

	<footer class="page-footer teal" id="contact">
		<div class="container">
			<div class="row">
				<div class="col l8 s12">
					<h5 class="white-text">Company Bio</h5>
					<p class="grey-text text-lighten-4">โครงงานบูรณาการร่วมระหว่างวิศวกรรมคอมพิวเตอร์และศึกษาศาสตร์ มหาวิทยาลัยเกษตรศาสตร์วิทยาเขตบางเขน เพื่อพัฒนาระบบการทดสอบสมรรถภาพทางกายให้สะดวกยิ่งขึ้น และสามารถประเมินผลได้อย่างถูกต้อง แม่นยำ และรวดเร็ว</p>
				</div>

				<div class="col l4 s12">
					<h5 class="white-text">Contact</h5>
					<ul>
						<li><a class="white-text" href="http://iwing.cpe.ku.ac.th">http://iwing.cpe.ku.ac.th</a></li>
						<li><a class="white-text" href="http://edu.ku.ac.th">http://edu.ku.ac.th</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				<div class="row">
					<div class="col l8 s12">
						All rights reserved. 2016
					</div>
					<div class="col l4 s12">
						Made by <a class="brown-text text-lighten-3" href="http://iwing.cpe.ku.ac.th">IWING</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!--  Scripts-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="js/materialize.js"></script>
	<script src="js/init.js"></script>

</body>
</html>
