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
				<li><a href="manager.html">Home</a></li>
				<li><a href="manager_tests.php">Tests</a></li>
				<li><a href="manager_stations.php">Stations</a></li>
				<li><a href="manager_enroll.php">Enrollment</a></li>
				<li><a href="#contact">Contact</a></li>
			</ul>

			<ul id="nav-mobile" class="side-nav">
				<li><a href="manager.html">Home</a></li>
				<li><a href="manager_tests.php">Tests</a></li>
				<li><a href="manager_stations.php">Stations</a></li>
				<li><a href="manager_enroll.php">Enrollment</a></li>
				<li><a href="#contact">Contact</a></li>
			</ul>
			<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
		</div>
	</nav>
  
	<div class="container">
		<div class="section">
			<div class="row">
				<div class="col s12 m8 offset-m2 left">
					<h5 style="word-wrap: break-word;">
						<ul class="collection with-header">
							<li class="collection-header center teal lighten-2 white-text text-lighten-2">
								<h3>Standby stations</h3>
							</li>

							<?php			
								$host = "localhost";
								$user = "art";
								$pass = "art12345678";
								$dbname="healthTest"; 
								
								$conn=mysql_connect($host,$user,$pass) or die("Can't connect");
								mysql_select_db($dbname) or die(mysql_error()); 
								mysql_query("SET NAMES UTF8");
								$data = mysql_query("SELECT station_name, station_unit FROM STATION")
										or die(mysql_error()); 
										
								$rows = array();
								while($r = mysql_fetch_assoc($data)) {
									$rows[] = $r;
								}
								$jsonTable = json_encode($rows);		
								$json_output = json_decode($jsonTable); 
								foreach ($json_output as $key)  
								{	
									print "<a href=\"manager_stations_edit.php?station_name={$key->station_name}&station_unit={$key->station_unit}\" class=\"collection-item brown-text\" >";
									print "{$key->station_name} ({$key->station_unit}) ";
									print "</a>";		
								} 	
							?>
						</ul>
					</h5>
				</div>
			</div>
		</div>
	</div>

	
	<div class="container">
		<div class="row">
			<div class="col s12">
				<h2 class="header center teal-text text-lighten-2">Create new station</h2>
				<div class="row">
					<form class="col s12" method="post" action="create_station.php" name="station_form" >
						<div class="row">
							<div class="input-field col s12 m6">
								<input id="stationname" name="stationname" type="text" class="validate" required>
								<label for="stationname">ชื่อฐานทดสอบ</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="stationunit" name="stationunit" type="text" class="validate" required>
								<label for="stationunit">หน่วยที่ใช้</label>
							</div>
							
							<div class="col s12"> 
								<br><br><b>กำหนดเกณฑ์การทดสอบ:</b>
							</div>
							
							<div class="col s12"> 
								<br><i class="material-icons ">person_pin</i> ชาย<br>
							</div>
							
								<div class="col s12"> 
									<br>อายุ 15-19 ปี
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="น้อยต่ำสุด" name="mage1519_bad_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="น้อยสูงสุด" name="mage1519_bad_high" type="number" step="0.01" class="validate" required >
								</div>								
								<div class="input-field col s6 m2">
									<input placeholder="กลางต่ำสุด" name="mage1519_mid_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="กลางสูงสุด" name="mage1519_mid_high" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="ดีต่ำสุด" name="mage1519_good_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="ดีสูงสุด" name="mage1519_good_high" type="number" step="0.01" class="validate" required >
								</div>

								<div class="col s12"> 
									<br>อายุ 20-24 ปี
								</div>

								<div class="input-field col s6 m2">
									<input placeholder="น้อยต่ำสุด" name="mage2024_bad_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="น้อยสูงสุด" name="mage2024_bad_high" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="กลางต่ำสุด" name="mage2024_mid_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="กลางสูงสุด" name="mage2024_mid_high" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="ดีต่ำสุด" name="mage2024_good_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="ดีสูงสุด" name="mage2024_good_high" type="number" step="0.01" class="validate" required >
								</div>
								
								<div class="col s12"> 
									<br>อายุ 25-30 ปี
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="น้อยต่ำสุด" name="mage2530_bad_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="น้อยสูงสุด" name="mage2530_bad_high" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="กลางต่ำสุด" name="mage2530_mid_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="กลางสูงสุด" name="mage2530_mid_high" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="ดีต่ำสุด" name="mage2530_good_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="ดีสูงสุด" name="mage2530_good_high" type="number" step="0.01" class="validate" required >
								</div>

								
							<div class="col s6"> 
								<br><br><i class="material-icons ">person_pin</i> หญิง<br>
							</div>
							
								<div class="col s12"> 
									<br>อายุ 15-19 ปี
								</div>
								
								<div class="input-field col s6 m2">
									<input placeholder="น้อยต่ำสุด" name="fage1519_bad_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="น้อยสูงสุด" name="fage1519_bad_high" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="กลางต่ำสุด" name="fage1519_mid_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="กลางสูงสุด" name="fage1519_mid_high" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="ดีต่ำสุด" name="fage1519_good_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="ดีสูงสุด" name="fage1519_good_high" type="number" step="0.01" class="validate" required >
								</div>
							
								<div class="col s12"> 
									<br>อายุ 20-24 ปี
								</div>
								
								<div class="input-field col s6 m2">
									<input placeholder="น้อยต่ำสุด" name="fage2024_bad_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="น้อยสูงสุด" name="fage2024_bad_high" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="กลางต่ำสุด" name="fage2024_mid_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="กลางสูงสุด" name="fage2024_mid_high" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="ดีต่ำสุด" name="fage2024_good_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="ดีสูงสุด" name="fage2024_good_high" type="number" step="0.01" class="validate" required >
								</div>
								
								<div class="col s12"> 
									<br>อายุ 25-30 ปี
								</div>
								
								<div class="input-field col s6 m2">
									<input placeholder="น้อยต่ำสุด" name="fage2530_bad_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="น้อยสูงสุด" name="fage2530_bad_high" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="กลางต่ำสุด" name="fage2530_mid_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="กลางสูงสุด" name="fage2530_mid_high" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="ดีต่ำสุด" name="fage2530_good_low" type="number" step="0.01" class="validate" required >
								</div>
								<div class="input-field col s6 m2">
									<input placeholder="ดีสูงสุด" name="fage2530_good_high" type="number" step="0.01" class="validate" required >
								</div>
							<br>
							<div class="input-field col s12 m6">	
								<input id="password" name="password" type="password" class="validate" required>
								<label for="password">Admin password</label>
							</div>
							<div class="input-field col s12">	
								<button class="btn btn-large waves-effect waves-light" type="submit" name="action">Create</button>
							</div>
							
						</div>
					</form>
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
